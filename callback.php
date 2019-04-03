<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <script>
        function normal(index,callback) {
            console.log('normal');
            console.log(callback);
            if (index == undefined) {
                return callback();    
            }else{
                console.log(index);
                return callback();
            }
        }

        function function1(callback) {
            console.log('function1');
            console.log(callback);
            callback(1,function(){console.log('inside');});
        }

        function1(normal);
    </script>
</body>
</html>
