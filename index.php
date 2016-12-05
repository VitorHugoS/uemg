<!DOCTYPE html>
<html>
<head>
	<title>Projeto Rover Nasa</title>

<script type="text/javascript" src="js/jquery.min.js"></script>


<script type="text/javascript" src="./chart.js"></script>
    <link rel="stylesheet" href="view-projeto/bower_components/codemirror/lib/codemirror.css">
    
    <!-- uikit -->
    <link rel="stylesheet" href="view-projeto/bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="view-projeto/assets/icons/flags/flags.min.css" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="view-projeto/assets/css/main.min.css" media="all">
<style type="text/css">

	#header_main{
		background-color: #000!important;
	}
	.uk-navbar>h2{
		text-align: center;
		color: #fff;
	}
	.md-btn-black{
		background-color: #000;
		color: #fff;
	}
	.md-btn-black:hover{
		background-color: #cecece;
		color: #fff;
	}

</style>
</head>

<body>
 <header id="header_main">
        <div class="header_main_content">
            <nav class="uk-navbar">
                <h2>Mars Rover</h2>
            </nav>
        </div>
</header>
<div id="page_content">
        <div id="page_content_inner">
        	<div class="md-card">
                	<div class="md-card-content">
				       <div class="md-card">
			                <div class="md-card-content">
			                    <div class="uk-grid" data-uk-grid-margin>
			                        <div class="uk-width-medium-1-3">
			                        <form>
			                            <label>Posição X</label>
			                            <input type="number" class="input-count md-input" name="x" id="input_counter" maxlength="3" />
			                        </div>
			                    
			                        <div class="uk-width-medium-1-3">
			                            <label>Posição Y</label>
			                            <input type="number" class="input-count md-input" name="y" id="input_counter" maxlength="3" />
			                        </div>
			                    
			                        <div class="uk-width-medium-1-3">
			                            <select name="face" data-md-selectize>
			                           		<option value="0">Face</option>
			                            	<option value="N">Norte</option>
			                            	<option value="S">Sul</option>
			                            	<option value="L">Leste</option>
			                            	<option value="O">Oeste</option>
			                            </select>
			                        </div>
			                    </div>
			                    <div class="uk-grid" data-uk-grid-margin>
			                    <div class="uk-width-medium-1-1">
			                            <label>Movimentar</label>
			                            <input type="text" class="input-count md-input" id="move" name="movimentar"  />
			                    </div>
			                    </div>
			                    <div class="uk-grid" data-uk-grid-margin>
			                     <div class="uk-width-medium-1-1">
			                    <button type="submit" class="md-btn md-btn-black md-btn-block md-btn-wave-light waves-effect waves-button waves-light">Posicionar</button>
			                    </div>
			                    </form>
			                    </div>
			                </div>
            			</div>
				    </div>
			</div>
			<div class="md-card">
                	<div class="md-card-content">
                	<canvas id="myChart" width="400" height="200"></canvas>
                	<script>
function chart(xdata, ydata){
var ctx = document.getElementById("myChart");
var myBubbleChart = new Chart(ctx,{
    type: 'bubble',
  data: {
        datasets: [{
            label: 'Posição do rover',
            data: [{
            	x: xdata,
                y: ydata,
                r: 0
            }],
            backgroundColor: [
                'rgba(0, 0, 0, 1.0)',
            ],
            borderColor: [
                'rgba(0,0,0,1.0)',
            ],
            borderWidth: 1
        }]
    },
    options: {
    	scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
}
$( "#move" ).keypress(function(e) {
	var l = 108;
	var r = 114;
	var m = 109;
	if((e.keyCode == l)||(e.keyCode == r)||(e.keyCode == m)){
	}else{
		e.preventDefault();
		alert("Digite valores válidos! (R - Direita, L - Esquerda, M - Movimentar)");
	}
});
$("form").submit(function (e){
	e.preventDefault();
	var x = $("input[name=x]").val();
	var y = $("input[name=y]").val();
	var face = $("select[name=face]").val();
	var movimentar = $("input[name=movimentar]").val();
	$.ajax({
		method: "POST",
		url: "./classe/Rover.php",
		data: {x: x, y: y, face: face, movimentar: movimentar},
		success: function (data){
			var obj = jQuery.parseJSON(data);
			chart(obj.x,obj.y);
		}
	});
});
</script>
                	</div>
            </div>

			
        </div>
</div>
   <script src="view-projeto/assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="view-projeto/assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="view-projeto/assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
    <!-- ionrangeslider -->
    <script src="view-projeto/bower_components/ion.rangeslider/js/ion.rangeSlider.min.js"></script>
    <!-- htmleditor (codeMirror) -->
    <script src="view-projeto/assets/js/uikit_htmleditor_custom.min.js"></script>
    <!-- inputmask-->
    <script src="view-projeto/bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>

    <!--  forms advanced functions -->
    <script src="view-projeto/assets/js/pages/forms_advanced.min.js"></script>

</body>
</html>