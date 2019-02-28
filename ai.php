<?php
require_once 'ai/AipImageClassify.php';

const APP_ID = '15646358';
const API_KEY = 'PbXxe3KMX3zx0FkiocSr9WU5';
const SECRET_KEY = 'QfGOSKXQM1BcbqZGuUGz7FzLt96vN1Tm';

$client = new AipImageClassify(APP_ID, API_KEY, SECRET_KEY);

if(isset($_POST['image'])){
	$image = file_get_contents('https://img0.bdstatic.com/static/searchdetail/img/logo-2X_0c4ef02.png');
	// 调用logo商标识别
	$client->logoSearch($image);

	// 如果有可选参数
	$options = array();
	$options["custom_lib"] = "false";

	// 带参数调用logo商标识别
	$client->logoSearch($image, $options);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>摄像头拍照</title>
</head>
<body>
  <video id="video" width="480" height="320" controls>
  </video>
  <div>
    <button id="capture">拍照</button>
  </div>
  <canvas id="canvas" width="480" height="320"></canvas>
  <script>
    //访问用户媒体设备的兼容方法
    function getUserMedia(constraints, success, error) {
      if (navigator.mediaDevices.getUserMedia) {
        //最新的标准API
        navigator.mediaDevices.getUserMedia(constraints).then(success).catch(error);
      } else if (navigator.webkitGetUserMedia) {
        //webkit核心浏览器
        navigator.webkitGetUserMedia(constraints,success, error)
      } else if (navigator.mozGetUserMedia) {
        //firfox浏览器
        navigator.mozGetUserMedia(constraints, success, error);
      } else if (navigator.getUserMedia) {
        //旧版API
        navigator.getUserMedia(constraints, success, error);
      }
    }

    let video = document.getElementById('video');
    let canvas = document.getElementById('canvas');
    let context = canvas.getContext('2d');

    function success(stream) {
      //兼容webkit核心浏览器
      let CompatibleURL = window.URL || window.webkitURL;
      //将视频流设置为video元素的源
      console.log(stream);

      //video.src = CompatibleURL.createObjectURL(stream);
      video.srcObject = stream;
      video.play();
    }

    function error(error) {
      console.log(`访问用户媒体设备失败${error.name}, ${error.message}`);
    }

    if (navigator.mediaDevices.getUserMedia || navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia) {
      //调用用户媒体设备, 访问摄像头
      getUserMedia({video : {width: 480, height: 320}}, success, error);
    } else {
      alert('不支持访问用户媒体');
    }

    document.getElementById('capture').addEventListener('click', function () {
      context.drawImage(video, 0, 0, 480, 320);      
    })
  </script>
</body>
</html>
