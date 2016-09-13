<?php namespace Powerplanetonline\LogViewer\Contracts;

/**
 * Interface  TableInterface
 *
 * @package   Powerplanetonline\LogViewer\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface TableInterface
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get table header.
     *
     * @return array
     */
    public function header();

    /**
     * Get table rows.
     *
     * @return array
     */
    public function rows();

    /**
     * Get table footer.
     *
     * @return array
     */
    public function footer();
}
