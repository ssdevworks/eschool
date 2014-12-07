<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ram" >
    <link rel="icon" href="../../favicon.ico">

    <title>e-school</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/cover.css" rel="stylesheet"> 
	
    
  </head>

  <body ng-app="eSchoolApp">

    <div class="site-wrapper">
	
      <div class="site-wrapper-inner">

		
        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">e-school management</h3>
              
             <div ng-include='"/templates/header.html"'></div>
            </div>
          </div>
	
	
			<div ui-view></div>
		<div ng-include='"/templates/footer.html"'></div>
        </div>

      </div>

    </div>
   <script src="/js/libs/angular.min.js"></script>
   <script src="/js/libs/angular-route.min.js"></script>
   <script src="/js/libs/angular-ui-router.min.js"></script>
   <script src="/js/libs/angular-cookies.js"></script>
   
   <script src="/js/controllers/authCtrl.js"></script> 
   <script src="/js/controllers/homeCtrl.js"></script> 
   <script src="/js/controllers/teacherCtrl.js"></script> 
   <script src="/js/controllers/studentCtrl.js"></script> 
   <script src="/js/controllers/parentCtrl.js"></script> 
   <script src="/js/controllers/classRoomCtrl.js"></script>
   <script src="/js/main.js"></script>
	 <script src="/js/libs/jquery.min.js"></script>	
   <script src="/js/libs/bootstrap.min.js"></script>
   <script src="/js/libs/ui-bootstrap-tpls-0.12.0.min.js"></script>
  </body>
</html>

