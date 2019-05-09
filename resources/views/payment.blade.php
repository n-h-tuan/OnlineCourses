<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <base href="{{asset('')}}">
  <title>Online Course</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  
  
  

</head>

<body>
    <div class="blur"></div>
  <section class="container">
        
        <div class="content">
            <p>Chúc mừng bạn đã thực hiện giao dịch thành công cho khóa học {{$TenKH}}. Code kích hoạt khóa học đã được gửi vào địa chỉ email "{{$email}}" của bạn</p>
            <a href="{{route('resend.code',['Code'=>$code_id, 'Email'=>$email])}}">Click vào đây nếu chưa nhận được mail</a>
            <p>Đảm bảo bạn đã nhận email trước khi tiếp tục</p>
            <a href='#' class="return-btn btn btn-success"><i class="fa fa-arrow-left"></i>  Quay lại trang chủ</a>
        </div>
      
  </section>
  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>