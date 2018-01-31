									<section>
										<form method="post" action="contact_form_handler.php" enctype="multipart/form-data">
											<div class="row 50%">
												<div class="6u 12u(mobile)">
													<input type="text" name="name" id="contact-name" placeholder="Name" value="Вася Пупкин"/>
												</div>
												<div class="6u 12u(mobile)">
													<input type="text" name="email" id="contact-email" placeholder="Email" value="pupkin@mail.com"/>
												</div>
											</div>
											<div class="row 50%">
												<div class="12u">
													<textarea name="message" id="contact-message" placeholder="Message" rows="4">Я Вася Пупкин</textarea>
												</div>
											</div>
											<div class="row 50%">
                							<div class="12u">
                   							<input type="file" name="image[]" multiple='multiple'/>
               								</div>
           									</div>
											<div class="row">
												<div class="12u">
													<ul class="actions">
														<li><input type="submit" class="style1" value="Send" /></li>
														<li><input type="reset" class="style2" value="Reset" /></li>
													</ul>
												</div>
											</div>
										</form>
									</section>