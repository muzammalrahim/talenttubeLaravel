{{-- <!DOCTYPE html>
<html>
<head> --}}
    {{-- <meta charset="utf-8"> --}}
    {{-- <title></title> --}}

    <style type="text/css"> 

    .loader{
    width: 150px;
    height: 150px;
    margin: 40px auto;
    transform: rotate(-45deg);
    font-size: 0;
    line-height: 0;
    animation: rotate-loader 5s infinite;
    padding: 25px;
    border: 1px solid #cf303d;
}
.loader .loader-inner{
    position: relative;
    display: inline-block;
    width: 50%;
    height: 50%;
}
.loader .loading{
    position: absolute;
    background: #cf303d;
}
.loader .one{
    width: 100%;
    bottom: 0;
    height: 0;
    animation: loading-one 1s infinite;
}
.loader .two{
    width: 0;
    height: 100%;
    left: 0;
    animation: loading-two 1s infinite;
    animation-delay: 0.25s;
}
.loader .three{
    width: 0;
    height: 100%;
    right: 0;
    animation: loading-two 1s infinite;
    animation-delay: 0.75s;
}
.loader .four{
    width: 100%;
    top: 0;
    height: 0;
    animation: loading-one 1s infinite;
    animation-delay: 0.5s;
}
@keyframes loading-one {
    0% {
        height: 0;
        opacity: 1;
    }
    12.5% {
        height: 100%;
        opacity: 1;
    }
    50% {
        opacity: 1;
    }
    100% {
        height: 100%;
        opacity: 0;
    }
}
@keyframes loading-two {
    0% {
        width: 0;
        opacity: 1;
    }
    12.5% {
        width: 100%;
        opacity: 1;
    }
    50% {
        opacity: 1;
    }
    100% {
        width: 100%;
        opacity: 0;
    }
}
@keyframes rotate-loader {
    0% {
        transform: rotate(-45deg);
    }
    20% {
        transform: rotate(-45deg);
    }
    25% {
        transform: rotate(-135deg);
    }
    45% {
        transform: rotate(-135deg);
    }
    50% {
        transform: rotate(-225deg);
    }
    70% {
        transform: rotate(-225deg);
    }
    75% {
        transform: rotate(-315deg);
    }
    95% {
        transform: rotate(-315deg);
    }
    100% {
        transform: rotate(-405deg);
    }
}
</style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

{{-- </head> --}}
{{-- <body> --}}
    <div class="container containerLoader">
        <div class="row">
            <div class="col-md-12">
                <div class="loader">
                    <div class="loader-inner">
                        <div class="loading one"></div>
                    </div>
                    <div class="loader-inner">
                        <div class="loading two"></div>
                    </div>
                    <div class="loader-inner">
                        <div class="loading three"></div>
                    </div>
                    <div class="loader-inner">
                        <div class="loading four"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </body> --}}
{{-- </html> --}}

