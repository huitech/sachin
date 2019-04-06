<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this -> load -> model('person');
        $this -> load -> model('Student_model');
        //$this -> is_logged_in();
    }
    function is_logged_in() {
		$is_logged_in = $this -> session -> userdata('is_logged_in');
		if (!isset($is_logged_in) || $is_logged_in != 1) {
			echo 'you have no permission to use developer area'. '<a href="">Login</a>';
			die();
		}
	}


    public function angular_view_welcome_student(){
        ?>
        <style type="text/css">
            #pin {
                -webkit-appearance: none;
                margin: 0;
                -moz-appearance: textfield;
            }


        </style>
        <div class="card" style="height: 100vh;">
            <!-- Nav project -->
            <div class="card-header bg-gray-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-gray-3">
                    <a class="navbar-brand" href="#">Student</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Master
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#!student">Student</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link</a>
                            </li>
                        
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" ng-model="searchItem" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" ng-click="getSearchItem(searchItem)" type="button">Search</button>
                        </form>
                    </div>
                </nav>
            </div>
            <!-- End of Nav project -->
            <div class="card-body">
                 <div id = "inputContainer" class = "inputDemo" ng-cloak>
                    <md-content layout-padding>
                        <form name = "studentForm">
                            <div class="d-flex">
                                <div class="col col-md-6 col-sm-12 bg-gray-2 p-3">

                                    <!--Student Name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Student Name</label>
                                        <input required name = "studentName" ng-model = "student.name" >
                                        <div ng-messages = "studentForm.studentName.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--Father's Name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Father's Name</label>
                                        <input required name = "father_name" ng-model = "student.father_name">
                                        <div ng-messages = "studentForm.father_name.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--Mother's Name-->
                                    <md-input-container  class = "col-5 md-block p-3">
                                        <label>Mother's Name</label>
                                        <input required name = "mother_name" ng-model = "student.mother_name">
                                        <div ng-messages = "studentForm.mother_name.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                     <!--Address 1-->
                                    <md-input-container class = "md-block p-3">
                                            <label>Address Line 1</label>
                                            <input md-maxlength = "100" required name = "address_line1"
                                                   ng-model = "student.address_line1">
                                            <div ng-messages = "studentForm.address_line1.$error">
                                                <div ng-message = "required">This is required.</div>
                                                <div ng-message = "md-maxlength">The Address has to be less
                                                    than 100 characters long.</div>
                                            </div>
                                    </md-input-container>

                                    <!--Address 2-->
                                    <md-input-container class = "md-block p-3">
                                        <label>Address Line 2</label>
                                        <input md-maxlength = "100" name = "address_line2"
                                               ng-model = "student.address_line2">
                                        <div ng-messages = "studentForm.address_line2.$error">
                                            <div ng-message = "md-maxlength">The Address has to be less
                                                than 100 characters long.</div>
                                        </div>
                                    </md-input-container>

                                    <!--police station Name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>PS Name</label>
                                        <input required name = "ps" ng-model = "student.ps_name">
                                        <div ng-messages = "studentForm.ps.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--pin number-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>pin</label>
                                        <input type="number" required id="pin" name = "pin" ng-model = "student.pin">
                                        <div ng-messages = "studentForm.pin.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--contact No. 1-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Contact Number 1</label>
                                        <input required name = "number1" ng-model = "student.contact1">
                                        <div ng-messages = "studentForm.number1.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--contact No. 2-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>Contact Number 2</label>
                                        <input name = "number2" ng-model = "student.contact2">
                                        <div ng-messages = "studentForm.number2.$error">
                                        </div>
                                    </md-input-container>

                                    <!--Email-->
                                    <md-input-container class = "col-3 md-block p-3">
                                        <label>Email</label>
                                        <input type = "email" name = "userEmail"
                                               ng-model = "student.email"
                                               minlength = "10" maxlength = "100" ng-pattern = "/^.+@.+\..+$/" />
                                        <div ng-messages = "studentForm.userEmail.$error" role = "alert">
                                            <div ng-message-exp = "['minlength', 'maxlength','pattern']">
                                                Your email must be between 10 and 100 characters long and should
                                                be a valid email address.
                                            </div>
                                        </div>
                                    </md-input-container>

                                    <!--board_name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>board</label>
                                        <md-select required name="board" ng-model="student.board" ng-change="selectSchoolsByBoardID(student.board)">
                                            <md-option ng-value="board" ng-repeat="board in allBoards">{{board.board_name}}</md-option>
                                        </md-select>
                                        <div ng-messages = "studentForm.board.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>


                                    <!--school_name-->
                                    <md-input-container class = "col-5 md-block p-3">
                                        <label>School</label>
                                        <md-select required name="school" ng-model="student.school" >
                                            <md-option ng-value="school" ng-repeat="school in selectedSchools">{{school.school_name}}</md-option>
                                        </md-select>
                                        <div ng-messages = "studentForm.school.$error">
                                            <div ng-message = "required">This is required.</div>
                                        </div>
                                    </md-input-container>

                                    <!--course-->
<!--                                    <md-input-container class = "col-5 md-block p-3">-->
<!--                                        <label>Course</label>-->
<!--                                        <md-select required name="course" ng-model="student.course" >-->
<!--                                            <md-option ng-value="course" ng-repeat="course in allcourse">{{course.cource_name}}</md-option>-->
<!--                                        </md-select>-->
<!--                                        <div ng-messages = "studentForm.course.$error">-->
<!--                                            <div ng-message = "required">This is required.</div>-->
<!--                                        </div>-->
<!--                                    </md-input-container>-->

                                    <md-input-container>
                                        <section layout="row" layout-sm="column" layout-align="center center" layout-wrap>
                                            <md-button class="md-raised md-primary" ng-click="saveDataToDatabase(student)" ng-disabled="!studentForm.$valid">Submit</md-button>
                                        </section>
                                    </md-input-container>
                                </div>
                                <div class="col bg-gray-3">
                                    <pre>student={{student | json}}</pre>
                                </div>
                            </div>
                        

                        
                        </form>
                    </md-content>
                </div>
            </div>
            <div class="card-footer" ng-show="showDeveloperArea">
                <div class="d-flex">
                    <div class="col bg-gray-3">
                        <pre>
                            selectedSchools={{selectedSchools | json}}
                        </pre>
                    </div>
                    <div class="col bg-gray-4">
                        <pre>
                            allboards={{allBoards | json}}
                        </pre>
                    </div>
                    <div class="col bg-gray-5">
                        <pre>
                            allschools={{allschools| json}}
                        </pre>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    function get_boards(){
        // in $post_data will store all the parameters in the query string
        $post_data =json_decode(file_get_contents("php://input"), true);


        $result=$this->Student_model->select_boards()->result();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }

    function get_Schools(){
        // in $post_data will store all the parameters in the query string
        $post_data =json_decode(file_get_contents("php://input"), true);

         $result = $this->Student_model->select_schools()->result();
         $report_array['records'] = $result;
         echo json_encode($report_array, JSON_NUMERIC_CHECK);
    }

    function get_Course(){
        // in $post_data will store all the parameters in the query string
        $post_data =json_decode(file_get_contents("php://input"), true);


        $result=$this->Student_model->select_course()->result();
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);

    }

    function save_new_student(){
        $post_data =json_decode(file_get_contents("php://input"), true);
        $result=$this->Student_model->insert_new_student((object)$post_data);
        $report_array['records']=$result;
        echo json_encode($report_array,JSON_NUMERIC_CHECK);
    }
}
?>