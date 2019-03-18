						<section class="panel">
							<div id="accordion">
								<div class="panel panel-accordion">
									<div class="panel-heading">
										<h4 class="panel-title">

											<!-- <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two"> -->
												<i class="fa fa-comment"></i> Messages
												<!-- </a> -->
											</h4>
										</div>
										<div>
											<div class="panel-body">

												<ul class="simple-user-list mb-xlg" id="append_msg">
													
												</ul>
												<div class="modal fade" id="message" role="dialog">
													<div class="modal-dialog">
														
														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" id="close_modal_view">&times;</button>
																<h4 class="modal-title">Message Content</h4>
															</div>
															<div class="modal-body">
																<div id="message_display"></div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" id="close_modal_view2">Close</button>
																</div>
															</div>
															
														</div>
													</div>
												</div>
												<div class="modal fade" id="reply_msg" role="dialog">
													<div class="modal-dialog">
														
														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" id="close_modalr_reply">&times;</button>
																<h4 class="modal-title">Reply</h4>
															</div>
															<div class="modal-body">
																<input type="hidden" id="msg_id">
																<div class="form-group">
																	<label class="col-md-3 control-label" for="textareaAutosize">Message Content</label>
																	<div class="col-md-6">
																		<textarea class="form-control" rows="3" id="msg_content" data-plugin-textarea-autosize></textarea>
																	</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-info" id="sent_reply">Send</button>
																	<button type="button" class="btn btn-default" id="close_modalr_reply2">Close</button>
																</div>
															</div>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</section>