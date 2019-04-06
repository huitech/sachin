app.controller("studentCtrl", function ($scope,$http,$filter,$timeout,dateFilter,$rootScope) {
    $scope.msg = "This is student controller";
    //Tab area
    $scope.tab = 1;
    $scope.setTab = function(newTab){
        $scope.tab = newTab;
    };
    $scope.isSet = function(tabNum){
        return $scope.tab === tabNum;
    };
    //End of tab area

    $scope.showDeveloperArea=true;

    $scope.student={address_line2:"",email:""};



    $scope.getSearchItem=function(searchItem){
        if(searchItem=="show-dev"){
            $scope.showDeveloperArea=!$scope.showDeveloperArea;
        }
    }



    $scope.loadBoards=function(){
        var request = $http({
            method: "post",
            url: site_url+"/Student/get_boards",
            data: {
            }
            ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function(response){
            $scope.allBoards=response.data.records;
        });
    };
    //calling loadBoards
    $scope.loadBoards();

    $scope.loadSchools=function(){
        var request = $http({
            method: "post",
            url: site_url+"/Student/get_Schools",
            data: {
            }
            ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function(response){
            $scope.allschools=response.data.records;
        });
    };
    //calling loadSchools
    $scope.loadSchools();

    // $scope.loadCourse=function(){
    //     var request = $http({
    //         method: "post",
    //         url: site_url+"/Student/get_Course",
    //         data: {
    //         }
    //         ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    //     }).then(function(response){
    //         $scope.allcourse=response.data.records;
    //     });
    // };
    //calling loadCourse
    // $scope.loadCourse();

    $scope.selectSchoolsByBoardID=function(selectedBoard){
        $scope.selectedSchools=alasql("select * from ? where board_id=?",[$scope.allschools,selectedBoard.id]);
    }
    $scope.saveDataToDatabase=function(tempStudent){
        var submitableStudent={};
        submitableStudent.address_line2=tempStudent.address_line2;
        submitableStudent.email=tempStudent.email;
        submitableStudent.name=tempStudent.name;
        submitableStudent.father_name=tempStudent.father_name;
        submitableStudent.mother_name=tempStudent.mother_name;
        submitableStudent.address_line1=tempStudent.address_line1;
        submitableStudent.ps_name=tempStudent.ps_name;
        submitableStudent.pin=tempStudent.pin;
        submitableStudent.contact1=tempStudent.contact1;
        submitableStudent.contact2=tempStudent.contact2;
        submitableStudent.school_id=tempStudent.school.id;

        /*********************************/
        var request = $http({
            method: "post",
            url: site_url+"/Student/save_new_student",
            data: {
                student: submitableStudent
            }
            ,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        }).then(function(response){
            $scope.reportArray=response.data.records;
            if($scope.reportArray.success==1){

            }
        });

        /*********************************/

    }

});

