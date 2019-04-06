<?php
class Student_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('huiui_helper');
    }
    function select_customers(){
        $sql="select person.person_id
		, person.person_cat_id
		, person.person_name
		, person.mailing_name
		, person.mobile_no
		, person.phone_no
		, person.email
		, person.aadhar_no
		, person.pan_no
		, person.address1
		, person.city
		, person.district_id
		, person.post_office
		, person.pin
		, person.gst_number
		, person.state_id
		 from person
		  inner join states on person.state_id = states.state_id
		  left outer join districts on person.district_id = districts.district_id
		  where person_cat_id=4";
        $result = $this->db->query($sql,array());
        return $result;
    }
    function select_states(){
        $sql="select * from states";
        $result = $this->db->query($sql,array());
        return $result;
    }

    function get_all_customers(){
        $sql="select id, person_name, mailing_name, sex, email, address_line1, address_line2, city, po, pin, state, contact_1, contact_2, person_category_id, district from person where person_category_id=5";
        $result = $this->db->query($sql,array());
        return $result;
    }
    function get_customer_by_id($customer_id){
        $sql="select id, person_name, mailing_name, sex, email, address_line1, address_line2, city, po, pin, state, contact_1, contact_2, person_category_id, district from person where person_category_id=5 and id=?";
        $result = $this->db->query($sql,array($customer_id));
        return $result;
    }
    function add_student($student){
        $return_array=array();
        $financial_year=get_financial_year();
        try{
            //$this->db->query("START TRANSACTION");
            $this->db->trans_start();
            //insert into maxtable
            $sql="insert into maxtable (subject_name, current_value, financial_year,prefix)
            	values('student',1,?,'C')
				on duplicate key UPDATE id=last_insert_id(id), current_value=current_value+1";
            $result=$this->db->query($sql,array($financial_year));
            if($result==FALSE){
                throw new Exception('Increasing Maxtable for Customer_id');
            }
            //Getting from max_table
            $sql="select * from maxtable where id=last_insert_id()";
            $result=$this->db->query($sql);
            if($result==FALSE){
                throw new Exception('error getting maxtable');
            }
            $student_id=$result->row()->prefix.'-'.leading_zeroes($result->row()->current_value,3).'-'.$financial_year;
            $return_array['student_id']=$student_id;
            $sql = "insert into person (
                       id
                      ,person_name
                      ,sex
                      ,email
                      ,address_line1
                      ,address_line2
                      ,dob
                      ,po
                      ,pin
                      ,contact1
                      ,contact2
                      ,person_category_id
                    ) VALUES (
                        ?,?,?,?,?,?,?,?,?,?,?,5
                        
                    )";

            $result=$this->db->query($sql,array(
                $return_array['student_id']
                ,$student->person_name
                ,$student->sex
                ,$student->email
                ,$student->address_line1
                ,$student->address_line2
                ,$student->dob
                ,$student->po
                ,$student->pin
                ,$student->contact1
                ,$student->contact2
            ));
            $return_array['dberror']=$this->db->error();
            if($result==FALSE){
                throw new Exception('error adding new customer');
            }
            $this->db->trans_complete();
            $return_array['success']=1;
            $return_array['message']='Successfully recorded';
        }catch(mysqli_sql_exception $e){
            //$err=(object) $this->db->error();

            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'purchase_model','insert_opening',"log_file.csv");
            $return_array['success']=0;
            $return_array['message']='test';
            $this->db->query("ROLLBACK");
        }catch(Exception $e){
            $err=(object) $this->db->error();
            $return_array['error']=create_log($err->code,$this->db->last_query(),'purchase_model','insert_opening',"log_file.csv");
            // $return_array['error']=mysql_error;
            $return_array['success']=0;
            $return_array['message']=$err->message;
            $this->db->query("ROLLBACK");
        }
        return (object)$return_array;
    }
    function student_update($student){
        $sql="update person set person_name=? where id=?";
        $result=$this->db->query($sql,array($student->person_name,$student->id));
    }
}//final

?>