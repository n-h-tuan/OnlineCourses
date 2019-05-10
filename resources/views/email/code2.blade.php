<!DOCTYPE html>
<html>
<head>
<style>
        table, th, td {
          border: 2px solid black;
        }
</style>
</head>
<body>
<div class="div">
    <h2 style="color:grey"> Online Courses </h2>
    <br>
    <h1 style="color:cornflowerblue"> Code Khóa Học </h1>
    <br>
    <p>Cám ơn bạn đã thực hiện giao dịch cho khóa học <br>
        <b> 
            @foreach($code_object_array as $code) 
                {{"• ".$code->khoa_hoc->TenKH}} <br> 
            @endforeach
        </b> 
    </p>
    <p>Đây là mã code để kích hoạt khóa học của bạn:  
        <table>
            <thead>
                <tr align="center">
                    <th> <b>KHÓA HỌC</b> </th>
                    <th> <b>CODE</b> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($code_object_array as $code)
                <tr align="center">
                    <th> {{$code->khoa_hoc->TenKH}} </th>
                    <th style="color:chocolate"> <b>{{$code->code}}</b>
                </tr>
                @endforeach
            </tbody>
        </table>
    </p>
    <br>
    <p>Nếu có vấn đề xảy ra vui lòng liên hệ về địa chỉ email <b style="color:goldenrod"> dtonlinecourse@gmail.com </b>
    <br></p>
    Thân ái,
    <br><br>
    Online Courses
</div>
</body>
</html>