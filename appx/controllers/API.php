<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Api extends REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('District_model');
        $this->load->model('Customer_model');
        $this->load->model('Student_model');
    }
    /******************************************  API for disstricts ***********************************************/
    //API -  Fetch Districts
    function districts_get(){
        //$id  = $this->get('id');
        $id = $this->uri->segment(3);
        if(!$id) {
            $result = $this->District_model->get_all_districts();
            if ($result) {
                echo json_encode($result,JSON_NUMERIC_CHECK);
                //$this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
        }else{
            $result = $this->District_model->get_district_by_id($id);
            if($result){
                //$this->response($result, 200);
                echo json_encode($result,JSON_NUMERIC_CHECK);
            }else{
                $this->response("Invalid id", 404);
            }
        }
    }

    //API - create a new district
    function districts_post(){
        $name      = $this->post('district_name');
        $state_id     = $this->post('state_id');


        if(!$name || !$state_id ){
            $this->response("Enter the district details to save", 400);
        }else{
            $result = $this->District_model->add(array("district_name"=>$name, "state_id"=>$state_id));
            if($result === 0){
                $this->response("District coild not be saved. Try again.", 404);
            }else{
                $this->response("success", 200);
            }
        }
    }

    //API - update district
    function districts_put(){

        $district_name      = $this->put('district_name');
        $state_id     = $this->put('state_id');
        $id        = $this->put('id');

        if(!$district_name || !$state_id || !$id){
            $this->response("Enter complete District information to update".$id, 400);
        }else{
            $result = $this->District_model->update($id, array("district_name"=>$district_name, "state_id"=>$state_id));
            if($result === 0){
                $this->response("District could not be updated. Try again.", 404);
            }else{
                $this->response("success", 200);
            }
        }
    }
    //API - delete district
    function districts_delete()
    {
        $id = $this->uri->segment(3);
        if(!$id){
            $this->response("Parameter missing for delete", 404);
        }

        if($this->District_model->delete($id))
        {
            $this->response("Success", 200);
        }
        else
        {
            $this->response("Failed", 400);
        }
    }
    /******************************************  API for disstricts ***********************************************/

    /******************************************  API for Customers ***********************************************/
    //API -  Fetch Customers
    function students_get(){
        $customer_id = $this->uri->segment(3);
        if(!$customer_id) {
            $result = $this->Customer_model->get_all_customers()->result_array();
            if ($result) {
                echo json_encode($result,JSON_NUMERIC_CHECK);
                //$this->response($result, 200);
            } else {
                $this->response("No record found", 404);
            }
        }else{
            $result = $this->Customer_model->get_customer_by_id($customer_id)->result_array();
            if($result){
                //$this->response($result, 200);
                echo json_encode($result,JSON_NUMERIC_CHECK);
            }else{
                $this->response("Invalid id", 404);
            }
        }
    }

    //API - create a new customers
    function students_post(){
        $student=array();
        $student['person_name']= $this->post('person_name');
        $student['sex']= $this->post('sex');
        $student['email']= $this->post('email');
        $student['address_line1']= $this->post('address_line1');
        $student['address_line2']= $this->post('address_line2');
        $student['dob']= $this->post('dob');
        $student['po']= $this->post('po');
        $student['pin']= $this->post('pin');
//        $customer['state']= $this->post('state');
        $student['contact1']= $this->post('contact1');
        $student['contact2']= $this->post('contact2');
        $student['school_id']= $this->post('school_id');

//        if(count($student)!=12){
//            $this->response("Enter customer details to save ", 400);
//        }



        if(!$student['person_name']){
            $this->response("Enter the customer details to save", 400);
        }else{
            $result = $this->Student_model->add_student((object)$student);
            if($result === 0){
                $this->response("District coild not be saved. Try again.", 404);
            }else{
                $this->response($result, 200);
            }
        }
    }

    //API - update Customer
    function students_put(){

        $student=array();
//        $student['id']=$this->uri->segment(3);
        $student['id']=$this->put('id');
        $student['person_name']= $this->put('person_name');
        $student['sex']= $this->put('sex');
        $student['email']= $this->put('email');
        $student['address_line1']= $this->put('address_line1');
        $student['address_line2']= $this->put('address_line2');
        $student['dob']= $this->put('dob');
        $student['po']= $this->put('po');
        $student['pin']= $this->put('pin');
//        $customer['state']= $this->post('state');
        $student['contact1']= $this->put('contact1');
        $student['contact2']= $this->put('contact2');
        $student['school_id']= $this->put('school_id');

//        if(count($customer)!=12){
//            $this->response("Enter customer details to save ".count($customer), 400);
//        }

        if(!$student['person_name'] ){
            $this->response("Enter complete District information to update", 400);
        }else{
            $result = $this->Student_model->student_update((object)$student);
            if($result === 0){
                $this->response("District could not be updated. Try again.", 404);
            }else{
                $this->response("success", 200);
            }
        }
    }


    /******************************************  End of API for Customers ***********************************************/
}