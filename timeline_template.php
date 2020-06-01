<?php /* Template Name: Timeline */


get_header(); ?>


<!-- Content -->
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background: #f3f3f3;
        font-family: vazir, sans-serif, Arial, Helvetica, sans-serif;
        color: #444;
        font-size: 14px;
    }

    a {
        color: #4d8fac;
        text-decoration: none;
        -webkit-transition: 0.5s;
        -moz-transition: 0.5s;
        -o-transition: 0.5s;
        -ms-transition: 0.5s;
        transition: 0.5s;
    }

    #main-content{
        padding: 30px;
        background: #eee;
        border: 1px solid #bdbddb;
        width: 94%;
        margin: auto;
    }
    #main-content p{
        font-size: 18px;
        font-family: vazir, sans-serif, Arial, Helvetica, sans-serif;
        line-height: 2;
        text-align: justify;
        color: #333333;
        margin: auto;
    }
    #issues a{
        background: #4d8fac;
        color: #fff;
        padding: 8px 16px;
        font-size: 16px;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
    }
    #issues a:hover{
        background-color: #89c4f4;
    }
    a.selected {
        color: #e5490a;
    }

    h1 {
        font-size: 30px;
        text-align: center;
        color: #333333;
    }
    h2 {
        font-size: 14px;
    }
    .sociales {
        text-align: center;
        margin-bottom: 20px;
    }

    #timeline {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        text-align: center;
        height: 900px;
        overflow: hidden;
        margin: 20px auto 100px auto;
        position: relative;
        background-color: white;
        width: 94%;
        border-radius: 15px;
        border: 2px solid #e0e0e0;
        padding: 24px;
    }
    #dates {
        width: 15%;
        height: 700px !important;
        overflow: hidden;
        float: left;
        margin-top: 100px !important;
        border-left: 2px dotted #bdbdbd;
    }
    #dates li {
        list-style: none;
        width: 100px;
        height: 100px;
        line-height: 100px;
        font-size: 24px;
        padding-left: 10px;
    }
    #dates a {
        line-height: 38px;
        padding-bottom: 10px;
    }
    #dates a::before{
        content: '\f111';
        font-family: 'FontAwesome';
        font-size: 15px;
        vertical-align: middle;
    }
    #dates .selected {
        font-size: 38px;
    }

    #issues {
        width: 100%;
        height: 800px;
        overflow: hidden;
        float: left;
        margin: auto;
    }
    .timeline-header{
        margin-top: 10px;
    }
    #issues h2{
        color: #444444;
        font-size: 20px;
        text-align: center;
        width: 100%;
    }
    #issues li {
        list-style: none;
        text-align: center;
    }
    #issues .content {
        color: #555;
        text-align: justify;
        line-height: 2;
        font-family: vazir, sans-serif, Arial, Helvetica, sans-serif;
        direction: rtl;
        padding: 10px 30px;
    }
    .persons {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        align-items: start;
        align-content: center;
        width: auto;
        height: 800px;
    }
    #issues li span.person{
        min-width: 350px;
        margin: 10px 60px;
        padding: 10px;
        background-color: #ffffff;
        box-shadow: 0 0 10px #bdbdbd;
        border-radius: 20px;
    }
    #issues li.selected img {
        border: 1px solid #bdbddb;
        border-radius: 100%;
        -webkit-transform: scale(1.1,1.1);
        -moz-transform: scale(1.1,1.1);
        -o-transform: scale(1.1,1.1);
        -ms-transform: scale(1.1,1.1);
        transform: scale(1.1,1.1);
    }
    #issues li img {
        width: 150px;
        margin: 20px auto;
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF)"; /* IE 8 */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF);/* IE 6 & 7 */
        zoom: 1;
        border-radius: 100%;
        -webkit-transition: all 1s ease-in-out;
        -moz-transition: all 1s ease-in-out;
        -o-transition: all 1s ease-in-out;
        -ms-transition: all 1s ease-in-out;
        transition: all 1s ease-in-out;
        -webkit-transform: scale(0.7,0.7);
        -moz-transform: scale(0.7,0.7);
        -o-transform: scale(0.7,0.7);
        -ms-transform: scale(0.7,0.7);
        transform: scale(0.7,0.7);
    }
    #issues li h1 {
        color: #e5490a;
        font-size: 36px;
        text-align: center;
        text-shadow: #000 1px 1px 2px;
    }
    #issues li p {
        font-size: 16px;
        margin: 10px 20px;
        font-weight: normal;
        line-height: 22px;
        padding: 10px;
        color: #444444;
        font-family: vazir, sans-serif, Arial, Helvetica, sans-serif;
        text-align: right;
        direction: ltr;
    }
    #issues li p i{
        margin-left: 6px;
        font-size: 20px;
        color: #444444;
    }

    #grad_top,
    #grad_bottom {
        width: 500px;
        height: 80px;
        position: absolute;
    }
    #grad_top {
        top: 0;
        /*background: url('http://www.csslab.cl/ejemplos/timelinr/latest/images/grad_top.png') repeat-x;*/
    }
    #grad_bottom {
        bottom: 0;
        /*background: url('http://www.csslab.cl/ejemplos/timelinr/latest/images/grad_bottom.png') repeat-x;*/
    }

    #next,
    #prev {
        position: absolute;
        left: 42%;
        font-size: 70px;
        width: 38px;
        height: 22px;
        background-position: 0 -44px;
        background-repeat: no-repeat;
        text-indent: -9999px;
        overflow: hidden;
    }
    #next:hover,
    #prev:hover {
        background-position:  0 0;
    }
    #next {
        bottom: 10px;
        /*background-image: url('images/timeline/next_v.png');*/
        background-image: url('/wp-content/themes/woodmart-child/images/timeline/next_v.png');
    }
    #prev {
        top: 10px;
        /*background-image: url('images/timeline/prev_v.png');*/
        background-image: url('/wp-content/themes/woodmart-child/images/timeline/prev_v.png');
    }
    #next.disabled,
    #prev.disabled {
        opacity: 0.2;
    }


    /*---------------------------- Media Queries ----------------------------*/

    @media screen and (max-width: 1100px) {
        #timeline{
            height: 1000px;
        }
        #issues li span.person{
            margin: 6px 24px;
        }
    }
    @media screen and (max-width: 1000px) {
        #issues li span.person{
            margin: 6px;
        }
        #dates  {
            margin-top: 250px !important;
        }
        #dates .selected {
            font-size: 34px;
        }
        #issues li span.person {
            min-width: 300px;
            border-radius: 16px;
        }
    }
    @media screen and (max-width: 860px) {
        #issues li span.person{
            margin: 4px;
            min-width: 275px;
            border-radius: 10px;
        }
        #dates a {
            font-size: 18px;
        }
        #dates .selected {
            font-size: 24px;
        }
        #issues li img {
            width: 120px;
            margin: 15px auto;
        }
        #issues li h1 {
            font-size: 30px;
        }
        #issues li p {
            font-size: 14px;
            margin: 8px 15px;
            line-height: 14px;
            padding: 10px;
        }
    }
    @media screen and (max-width: 760px) {
        #dates a {
            font-size: 16px;
        }
        #dates li {
            padding-left: 0;
            width: 70px;
        }
        #dates .selected {
            font-size: 20px;
        }
        #issues li img {
            width: 100px;
            margin: 12px auto;
        }
        #issues li h1 {
            font-size: 30px;
        }
        #issues li p {
            direction: ltr;
            font-size: 14px;
            margin: 8px;
            line-height: 14px;
            padding: 8px;
        }
        #issues li span.person{
            margin: 20px auto;
            min-width: 250px;
        }
    }
    @media screen and (max-width: 650px) {
        #issues li span.person{
            margin: 2px;
            min-width: 200px;
        }
        #dates a {
            font-size: 14px;
        }
        #dates li {
            padding-left: 0;
            width: 65px;
        }
        #dates .selected {
            font-size: 18px;
        }
        #issues li img {
            width: 85px;
            margin: 15px auto;
        }
        #issues li h1 {
            font-size: 26px;
        }
        #issues li p {
            font-size: 12px;
            margin: 6px;
            padding: 6px;
        }
    }
    @media screen and (max-width: 600px) {
        #issues li span.person{
            margin: 2px;
            min-width: 175px;
        }
        #dates {
            margin-top: 125px !important;
        }
        #dates li {
            padding-left: 0;
            width: 50px;
        }
        #dates a {
            font-size: 13px;
        }
        #dates .selected {
            font-size: 16px;
        }
        #issues li {
            margin-top: 50px;
        }
        #issues li img {
            width: 70px;
            margin: 15px auto;
        }
        #issues li h1 {
            font-size: 20px;
        }
        #issues li p {
            font-size:10px;
            margin: 4px;
            padding: 4px 0;
        }
        #issues a {
            font-size: 13px;
            border-radius: 2px;
        }
        #issues li p i {
            font-size: 16px;
        }
    }
    @media screen and (max-width: 500px) {
        #main-content p {
            font-size: 14px;
        }
        #issues li span.person{
            margin: 0;
            min-width: 110px;
            width: auto;
            border-radius: 6px;
        }
        #dates {
            margin-top: 300px !important;
        }
        #dates a {
            font-size: 10px;
        }
        #dates li {
            width: 30px;
        }
        #dates .selected {
            font-size: 12px;
        }
        #issues li p i {
            font-size: 14px;
        }
    }
    @media screen and (max-width: 400px) {
        #dates {
            width: 20%;
        }
        #dates a {
            font-size: 8px;
        }
        #dates .selected {
            font-size:10px;
        }
        #issues li img {
            width: 50px;
            margin: 8px auto;
        }
        #issues li h1 {
            font-size: 18px;
        }
        #issues li p {
            font-size:8px;
            margin: 16px 0;
        }
        #issues a {
            font-size: 11px;
        }
        #issues li p i {
            font-size: 12px;
        }
    }



</style>


<div id="main-content">
    <p>چند سالی است وب سایت KnowledgePlus.ir در راستای اهداف عالی آموزشی سایت و ایجاد انگیزه در افراد مستعد و متخصص، همچنین ایفای نقشی در رشد جامعه علمی کشور، اقدام به برگذاری مسابقات علمی با موضوعات و جوایز مختلف می نماید. سیسوگ نیز بنا به رسالت خود، این مجموعه آموزشی را معرفی می کند.</p>
</div>

<div id="timeline">
    <ul id="dates">
        <li><a href="#1393" class="selected">1393</a></li>
        <li><a href="#1394">1394</a></li>
        <li><a href="#1395">1395</a></li>
        <li><a href="#1396">1396</a></li>
        <li><a href="#1397">1397</a></li>
    </ul>

    <ul id="issues">
        <li id="1393" class="selected">
            <div class="row timeline-header">
                <h2>مسابقه علمی سال 1393</h2>
                <p class="content">سال 93 اولین مسابقه علمی با موضوع ارائه کتابخانه های کاربردی مبتنی بر میکروکنترلرهای AVR و XMEGA برگزار گردید که جناب آقای مهدی سلگی با طرح "اتصال HMI به XMEGA با پروتکل Modbus RTU" در رتبه اول و آقای ایمان باقری با طرح "ارسال و نمایش اطلاعات ماژول شتاب سنج بصورت بیسیم" جایگاه دوم این مسابقه را کسب نمودند.</p>
            </div>
            <div class="persons">
                <span class="person">
               <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/مهدی-سلگی.jpg"; ?>" />
            <h1>نفر اول</h1>
             <p>  آقای مهدی سلگی<i class="fa fa-user"></i></p>
            <p>  <span> Rial 20000000 </span> <i class="fa fa-money"></i></p>
            <p>  <span> controlsystemco.com  </span> <i class="fa fa-globe"></i></p>
            <p><span>mehdi_solgi@yahoo.com</span> <i class="fa fa-envelope"></i></p>
            <p style="text-align: center"><a href="https://b2.sisoog.com/file/zmedia/knowledgeplus/93_1.rar" class="btn btn-outline-info" target="_blank">دانلود طرح</a></p>
            </span>
                <span class="person">
               <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/ایمان-باقری.jpg"; ?>"  />
            <h1>نفر دوم</h1>
            <p>  آقای ایمان باقری<i class="fa fa-user"></i></p>
            <p>  <span> Rial 10000000 </span> <i class="fa fa-money"></i></p>
            <p>  <span> ---  </span> <i class="fa fa-globe"></i></p>
            <p><span>iman28aban@gmail.com</span> <i class="fa fa-envelope"></i></p>
            <p style="text-align: center"><a href="https://b2.sisoog.com/file/zmedia/knowledgeplus/93_2.rar" class="btn btn-outline-info" target="_blank">دانلود طرح</a></p>
            </span>
            </div>
        </li>

        <li id="1394">
            <div class="row timeline-header">
                <h2>مسابقه علمی سال 1394</h2>
                <p class="content">موضوع دومین دوره مسابقه عبارت است از پیاده سازی ساز و کاری که بتوان از راه دور و از طریق خط تلفن و یا ماژول های gsm، برنامه یک میکروکنترلر AVR را بروز رسانی کرد. اولویت در این مسابقه با روش هایی است که با کمترین هزینه، امکان برنامه ریزی میکروکنترلر را فراهم کنند. اما جالب است بدانید در این سری مسابقه، علیرغم اعلام آمادگی چندین نفر برای شرکت در مسابقه و چند ماه مهلت برای به نتیجه رساندن کار، در نهایت هیچ فرد یا گروهی موفق به انجام و ارائه طرح نهایی نگردید!</p>
            </div>
            <div class="persons">
                <span class="person">
               <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/not-found.jpg"; ?>" />
            </span>
            </div>
        </li>

        <li id="1395">
            <div class="row timeline-header">
                <h2>مسابقه علمی سال ۱۳۹۵</h2>
                <p class="content">سومین دوره مسابقه علمی سایت نالج پلاس (KnowledgePlus.ir) در سال ۱۳۹۵ با موضوع تدوین جامع ترین و کاربردی ترین منبع آموزشی برای پیاده سازی پروتکل Ethernet برگزار شد، که جناب آقای محمد حسین کوهی قمصری جایگاه اول و آقای سوران آراسته به عنوان نفر دوم مسابقه معرفی شدند.</p>
            </div>
            <div class="persons">
            <span class="person">
                   <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/محمد-حسین-کوهی-قمصری.jpg"; ?>" />
            <h1>نفر اول</h1>
                <p>  آقای محمد حسین کوهی قمصری<i class="fa fa-user"></i></p>
            <p>  <span> Rial 30000000 </span> <i class="fa fa-money"></i></p>
            <p>  <span> ---  </span> <i class="fa fa-globe"></i></p>
            <p><span>Mohammadghamsari@ieee.org</span> <i class="fa fa-envelope"></i></p>
            <p style="text-align: center"><a href="https://b2.sisoog.com/file/zmedia/knowledgeplus/95_1.rar" class="btn btn-outline-info" target="_blank">دانلود طرح</a></p>
            </span>
                <span class="person">
                     <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/سوران-آراسته.jpg"; ?>" />
            <h1>نفر دوم</h1>
                                         <p>  آقای سوران آراسته<i class="fa fa-user"></i></p>
            <p>  <span> Rial 15000000 </span> <i class="fa fa-money"></i></p>
            <p>  <span> ---  </span> <i class="fa fa-globe"></i></p>
            <p><span>Soran.arasteh@gmail.com</span> <i class="fa fa-envelope"></i></p>
            <p style="text-align: center"><a href="https://b2.sisoog.com/file/zmedia/knowledgeplus/95_2.rar" class="btn btn-outline-info" target="_blank">دانلود طرح</a></p>
            </span>
            </div>
        </li>

        <li id="1396">
            <div class="row timeline-header">
                <h2>مسابقه علمی سال ۱۳۹۶</h2>
                <p class="content">چهارمین دوره مسابقه علمی در سال ۱۳۹۶ با موضوع انتقال فریم های دوربین هایی نظیر ov7670 از طریق یک ماژول GSM/GPRS و نمایش و ذخیره سازی آن در مقصد برگزار شد که جناب آقای محمد مزارعی و آقای مصطفی کشاورز، برندگان این مسابقه اعلام شدند.</p>
            </div>
            <div class="persons">

                <span class="person">
                <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/محمد-مزارعی.jpg"; ?>" />
            <h1>نفر اول</h1>
                                                         <p>  آقای محمد مزارعی<i class="fa fa-user"></i></p>
            <p>  <span> Rial 50000000 </span> <i class="fa fa-money"></i></p>
            <p>  <span> ---  </span> <i class="fa fa-globe"></i></p>
            <p><span>mohammad.mazarei@gmail.com</span> <i class="fa fa-envelope"></i></p>
            <p style="text-align: center"><a href="https://b2.sisoog.com/file/zmedia/knowledgeplus/96_1.rar" class="btn btn-outline-info" target="_blank">دانلود طرح</a></p>
            </span>
                <span class="person">
                  <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/مصطفی-کشاورز.jpg"; ?>" />
            <h1>نفر دوم</h1>
                                     <p>  آقای مصطفی کشاورز<i class="fa fa-user"></i></p>
            <p>  <span> Rial 20000000 </span> <i class="fa fa-money"></i></p>
            <p>  <span> ---  </span> <i class="fa fa-globe"></i></p>
            <p><span>info@smart-device.ir</span> <i class="fa fa-envelope"></i></p>
            <p style="text-align: center"><a href="https://b2.sisoog.com/file/zmedia/knowledgeplus/96_2.rar"  class="btn btn-outline-info" target="_blank">دانلود طرح</a></p>
            </span>
            </div>
        </li>

        <li id="1397">
            <div class="row timeline-header">
                <h2>مسابقه علمی سال 1397</h2>
                <p class="content">پنجمین دوره مسابقه علمی در سال ۱۳۹۷ با موضوع تدوین جامع ترین و کاربردی ترین منبع آموزشی به همراه مثال های کاربردی برای پیاده سازی ارتباط USB در مدها و کلاس های مختلف روی یکی از شماره های خانواده stm32 برگزار شد که برنده این مسابقه جناب آقای مهدی داداشی بودند.</p>
            </div>
            <div class="persons">
                  <span class="person">
                     <img src="<?php echo get_stylesheet_directory_uri(). "/images/timeline/مهدی-داداشی.jpg"; ?>" />
            <h1>نفر اول</h1>
              <p>  آقای مهدی داداشی<i class="fa fa-user"></i></p>
            <p>  <span> Rial 70000000 </span> <i class="fa fa-money"></i></p>
            <p>  <span> mahdidadashi.ir  </span> <i class="fa fa-globe"></i></p>
            <p><span>Mahdidadashi@gmail.com</span> <i class="fa fa-envelope"></i></p>
            <p style="text-align: center"><a href="https://github.com/mahdidadashi65/STM32_USB_Tutorials" target="_blank" rel="nofollow" class="btn btn-outline-info">دانلود طرح</a></p>
            </span>
            </div>
        </li>
    </ul>

    <div id="grad_top" style="display: none"></div>
    <div id="grad_bottom" style="display: none"></div>
    <a href="#" id="next">+</a>
    <a href="#" id="prev">-</a>
</div>

<!-- Content -->


<?php //get_sidebar(); ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://www.csslab.cl/ejemplos/timelinr/latest/js/jquery.timelinr-0.9.54.js"></script>
<script language="JavaScript" type="application/javascript">
    $(function(){
        $().timelinr({
            orientation: 	'vertical',
            issuesSpeed: 	300,
            datesSpeed: 	100,
            arrowKeys: 		'true',
            startAt:		3
        })
    });
</script>


<?php get_footer(); ?>
