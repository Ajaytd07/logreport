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

namespace block_logreport;

/**
* @class dataprovider
*/
class dataprovider
{
	public function generate_logreport($start = 0,$length = 10){
		global $DB;

		$logsql   = "SELECT timecreated,userid,relateduserid,component,eventname,target,origin,ip 
					   FROM {logstore_standard_log} 
					  WHERE anonymous = 0 ORDER BY timecreated DESC, id LIMIT $start, $length ";

		$countsql = 'SELECT count(id) FROM {logstore_standard_log} 
					WHERE anonymous = 0 ORDER BY timecreated DESC, id';

		$totalrecords = $DB->count_records_sql($countsql); 

		$logdata = $DB->get_records_sql($logsql);

		return compact('totalrecords','logdata');
	}
}