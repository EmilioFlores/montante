$(document).ready(function(){
						$('#ecuaciones, #incognitas').on('input', function(){
							var $ecsCant = $('#ecuaciones').val();
							var $incogCant = $('#incognitas').val();
							if ($incogCant != $ecsCant) {
								
								$('#error').show().text('The number of ecuations must be equal to the number of unknown variables')
							}
							else {
								$('#error').hide();
							}
						});
						$('#go-back').click(function(){
							$('#result').empty();
							$('#input-wrapper, #insert-ecuations').show(700);
							$('#ecs-div').empty();
							$(this).hide(700);
							$('#start-method').hide(700);
						});
						$('#insert-ecuations').click(function() {
							var $ecsCant = $('#ecuaciones').val();
							var $incogCant = $('#incognitas').val();

							if ($incogCant == $ecsCant) {
								$('#input-wrapper, #insert-ecuations').hide(700);
							var $table = "<table class='table'>";
									$table += "<thead><tr>";
										$table += "<th>Ecuation / Variable </th>";
										for (var i = 0; i < $ecsCant; i++) {
											$table += "<th class='text-center'> X"+i+"</th>";
										}
										$table += "<th class='text-center'>Coefficient</th>";
									$table += "</tr></thead>";
									$table += "<tbody>";
										for (var i = 0; i < $ecsCant; i++) {
											$table += "<tr>";
											$table += "<td> Ecuation " + parseInt(i+1) + "</td>";
											for (var j = 0; j <= $incogCant; j++ ) {
												$table += "<td class='number'><input type='text' id='x-"+i+"-"+j+"' onkeypress='validate(event);'value='1'></td>";
											}

											$table += "</tr>";
										}
										
									$table += "</tbody>";
								$table += "</table>"; 
								
								$('#go-back').show(700);
								$('#ecs-div').append($table);
								$('#start-method').show(700);
								
							}
							else {
								$('#error').show().text('Cannot continue. The number of ecuations must be equal to the number of unkown variables');
								return false;
							}
						});

						$('#start-method').click(function(){
							$('#result').empty();
							console.log('Entro');
							var $ecsCant = $('#ecuaciones').val();
							var $incogCant = $('#incognitas').val();
							var $errors = 0;
							// validate not empty inputs
							for (var i = 0; i < $ecsCant; i++) {
								for (var j = 0; j <= $incogCant; j++ ) {
									var $cell = $('#x-'+ i +'-'+ j);
									if (!$cell.val()) {
										$cell.css('border','solid 1px red');
										$errors++;
										$('#error').show().text('Please fill the cels with the appropiate coeficients for the equation');
									}
									else {
										$cell.css('border','2px inset');
									}
								}

							}
							// Continue if no errors
							if ($errors == 0) {
								var ecuations = [];
								for (var i = 0; i < $ecsCant; i++) {
									ecuations.push(Array());
									for (var j = 0; j <= $incogCant; j++ ) {

										var $cell = $('#x-'+ i +'-'+ j);
										ecuations[i].push($cell.val());
										
									}
								}
								var $ecuationsString = JSON.stringify(ecuations);
								$.ajax({
								  method: "POST",
								  url: "../controller.php",
								  data: { 
								  	action : "montante",
								  	ecs : $ecuationsString,
								  	incognitas : $incogCant
								  },
								  success : function(json) {
								  		console.log("termino");
								  		$('#result').append(json);
								  },
								  error : function(json) {

								  	console.log("Error", json);
								  }
								});

							}

						});
					});
					function validate(evt) {
					  var theEvent = evt || window.event;
					  var key = theEvent.keyCode || theEvent.which;
					  key = String.fromCharCode( key );
					  var regex = /[0-9]|-|\./;
					  if( !regex.test(key) ) {
					    theEvent.returnValue = false;
					    if(theEvent.preventDefault) theEvent.preventDefault();
					  }
					}