<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="filter.css">
	</head>
	<body>
<div class="panel panel-2 panel-default">
    			        <div class="panel-body">
                            <form class="search rel" action="search_form.php" method="post">
                                        <div class=" rel">
                                            <h4 class="center search-text">I'm</h4>
                                            <div class="labeles-div">
                                                <label class="labeles">
                                                    <input class="radio radio1" type="radio" name="Radios1" id="r1-m" value="male" <?php if (isset($_POST[ 'Radios1']) && $_POST[ 'Radios1']=='male' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label_r">Man</div>
                                                </label>
                                                <label class="labeles">
                                                    <input class="radio radio1" type="radio" name="Radios1" id="r1-f" value="female" <?php if (isset($_POST[ 'Radios1']) && $_POST[ 'Radios1']=='female' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label_r">Woman</div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="rel">
                                            <h4 class="center  search-text">I'm looking for</h4>
                                            <div class="labeles-div">
                                                <label class="labeles">
                                                    <input class="radio radio2" type="radio" name="Radios2" id="r2-m" value="male" <?php if (isset($_POST[ 'Radios2']) && $_POST[ 'Radios2']=='male' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label_r">Man</div>
                                                </label>
                                                <label class="labeles">
                                                    <input class="radio radio2" type="radio" name="Radios2" id="r2-f" value="female" <?php if (isset($_POST[ 'Radios2']) && $_POST[ 'Radios2']=='female' ){echo ' checked="checked"';}?>>
                                                    <span class="radio-custom"></span>
                                                    <div class="label_r">Woman</div>
                                                </label>
                                            </div>
                                        </div>
                                <div class="slider">
                                    <p class="center slider-age">Choose age</p>
                                    <div class="rel">
                                      <input type="text" class="inputs-age" name ="amount" id="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>" readonly>
                                      <input type="text" class="inputs-age" name ="amount-2" id="amount-2" value="<?php echo isset($_POST['amount-2']) ? $_POST['amount-2'] : '' ?>" readonly>
                                    </div>
                                    <div id="slider-range"></div>
                                </div>
                                <div class="form-group search-btn-block">
                                    <input class="search-btn btn btn-lg btn-danger" id="search" onclick="location.href = 'search_form.php';" type="submit" name="search" value="Search">
                                </div>
                            </form>
    			        </div>
    		        </div>
                </div>
                


              <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
   
    <script src="jquery.ui.touch-punch.min.js"></script>
<script>$('.ui-slider-handle').draggable();</script>
<script>
    $(function(){
        $('.radio1').change(function(){
             if($(this).val() == "female")
                $( "#r2-m" ).prop( "checked", true );
            else $( "#r2-f" ).prop( "checked", true );
        });
        $('.radio2').change(function(){
            if($(this).val() == "female")
                $( "#r1-m" ).prop( "checked", true );
            else $( "#r1-f" ).prop( "checked", true );
        });
    });
</script>
<script>
document.getElementById("amount").defaultValue = 18; 
document.getElementById("amount-2").defaultValue = 45;
</script>
<script>
$( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 18,
      max: 70,
      values: [ $("#amount").val(), $("#amount-2").val() ],
      slide: function( event, ui ) {
        $( "#amount" ).val(ui.values[ 0 ]  );
        $( "#amount-2" ).val(ui.values[ 1 ] );
        $( "#amount" ).value = ui.values[ 0 ];
        $( "#amount-2" ).value = ui.values[ 1 ];
      }
    });
    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) );
	$( "#amount-2" ).val($( "#slider-range" ).slider( "values", 1 ) );
  } );
$(document).ready(function(){
    	$("#amount").change(function(){
           $( "#amount" ).value = ui.values[ 0 ];
        });
   
        $("#amount-2").change(function(){
           $( "#amount-2" ).value = ui.values[ 1 ];
        });
    });
  </script>

</body>
</html>
  