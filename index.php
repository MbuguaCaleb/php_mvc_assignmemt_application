<?php
//This is a controller
require('model/database.php');
require('model/assignments_db.php');
require('model/course_db.php');


//Data this controller will receive
$assignment_id = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
$course_name = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_STRING);

//May come either via POST or as a GET Request
$course_id = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
if (!$course_id) {
    $course_id = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = 'list_assignments';
    }
}

switch ($action) {

        //lists all assignments
    default:
        $course_name = get_course_name($course_id);
        $courses = get_courses();
        $assignments = get_assignments_by_course($course_id);
        include('view/assignment_list.php');
}
