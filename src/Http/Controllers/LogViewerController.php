<?php namespace Powerplanetonline\LogViewer\Http\Controllers;

use Powerplanetonline\LogViewer\Bases\Controller;
use Powerplanetonline\LogViewer\Entities\Log;
use Powerplanetonline\LogViewer\Exceptions\LogNotFound;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class     LogViewerController
 *
 * @package  LogViewer\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @todo     Refactoring & Testing
 */
class LogViewerController extends Controller
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    protected $perPage = 30;

    /* ------------------------------------------------------------------------------------------------
     |  Constructor
     | ------------------------------------------------------------------------------------------------
     */
    public function __construct()
    {
        parent::__construct();

        $this->perPage = config('log-viewer.per-page', $this->perPage);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats    = $this->logViewer->statsTable();
        $reports  = $stats->totalsJson();
        $percents = $this->calcPercentages($stats->footer(), $stats->header());

        return $this->view('dashboard', compact('reports', 'percents'));
    }

    public function listLogs()
    {
        $stats   = $this->logViewer->statsTable();

        $headers = $stats->header();
        // $footer   = $stats->footer();

        $page    = request('page', 1);
        $offset  = ($page * $this->perPage) - $this->perPage;

        $rows    = new LengthAwarePaginator(
            array_slice($stats->rows(), $offset, $this->perPage, true),
            count($stats->rows()),
            $this->perPage,
            $page
        );

        $rows->setPath(request()->url());

        return $this->view('logs', compact('headers', 'rows', 'footer'));
    }

    /**
     * Show the log.
     *
     * @param  string  $date
     *
     * @return \Illuminate\View\View
     */
    public function show($date,$area)
    {
        $log     = $this->getLogOrFail($date);
        $levels  = $this->logViewer->levelsNames();
        $entries = $log->entries()->paginate($this->perPage,$area);

        return $this->view('show', compact('log', 'levels', 'entries'));
    }

    /**
     * Filter the log entries by level.
     *
     * @param  string  $date
     * @param  string  $level
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
     public function showByLevel($date, $level)
     {
         $log = $this->getLogOrFail($date);
         $levels  = $this->logViewer->levelsNames();

         if ($level=='all')
            $entries = $log->entries()->paginate($this->perPage,$level);
        else
            $entries = $this->logViewer
                 ->entries($date, $level)
                 ->paginate($this->perPage);

         if ($level == 'info') {

             return $this->view('show-info', compact('log', 'levels', 'entries'));
         }

         return $this->view('show', compact('log', 'levels', 'entries'));
     }

    /**
     * Download the log
     *
     * @param  string  $date
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($date)
    {
        return $this->logViewer->download($date);
    }

    /**
     * Delete a log.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete()
    {
        if ( ! request()->ajax()) abort(405, 'Method Not Allowed');

        $date = request()->get('date');
        $ajax = [
            'result' => $this->logViewer->delete($date) ? 'success' : 'error'
        ];

        return response()->json($ajax);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Other Functions
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get a log or fail
     *
     * @param  string  $date
     *
     * @return Log|null
     */
    private function getLogOrFail($date)
    {
        $log = null;

        try {
            $log = $this->logViewer->get($date);
        }
        catch(LogNotFound $e) {
            abort(404, $e->getMessage());
        }

        return $log;
    }

    /**
     * Calculate the percentage
     *
     * @param  array  $total
     * @param  array  $names
     *
     * @return array
     */
    private function calcPercentages(array $total, array $names)
    {
        $percents = [];
        $all      = array_get($total, 'all');

        foreach ($total as $level => $count) {
            $percents[$level] = [
                'name'    => $names[$level],
                'count'   => $count,
                'percent' => $all ? round(($count / $all) * 100, 2) : 0,
            ];
        }

        return $percents;
    }
}
