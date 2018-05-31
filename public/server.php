<?php
/*
 * psx
 * A object oriented and modular based PHP framework for developing
 * dynamic web applications. For the current version and informations
 * visit <http://phpsx.org>
 *
 * Copyright (c) 2010-2015 Christoph Kappestein <k42b3.x@gmail.com>
 *
 * This file is part of psx. psx is free software: you can
 * redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or any later version.
 *
 * psx is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with psx. If not, see <http://www.gnu.org/licenses/>.
 */

// router file which can be used by the PHP internal web server. All requests to
// the documentation folder are not handeled by psx
if (preg_match('/^\/documentation\//', $_SERVER['REQUEST_URI'])) {
	return false;
}

// strip if the requests starts with /index.php/
if (isset($_SERVER['REQUEST_URI']) && substr($_SERVER['REQUEST_URI'], 0, 11) == '/index.php/') {
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], 10);
}

require_once(__DIR__ . '/index.php');
