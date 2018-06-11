<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Displays different views of the logs.
 *
 * @package    blockl_report
 * @copyright  2018 onwards Naveen kumar(naveen@eabyas.in)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_logreport extends block_base {
    function init() {
        global $PAGE;
        $this->title = get_string('pluginname', 'block_logreport');
        $PAGE->requires->css('/blocks/logreport/style/datatables.min.css');
    }

    function get_content() {

        if ($this->content !== null) {
            return $this->content;
        }
        $output = $this->page->get_renderer('block_logreport');
        
        $this->content         = new stdClass;
        $this->content->text  = '';
        $this->page->requires->js_call_amd('block_logreport/logreport', 'InitDatatable');

        $data = (new \block_logreport\dataprovider)->generate_logreport();
        $renderable = new \block_logreport\output\renderreport($data);

        $this->content->text = $output->render($renderable);
        
        return $this->content;
    }
}