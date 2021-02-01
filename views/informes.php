				<!-- Informes -->
					<section class="wrapper style1 align-center">
						<div class="inner medium">
							<h2>Solicitar informe VERAZ</h2>
							<form method="post" action="./mp_veraz">
								<div class="fields">
									<div class="field half">
										<label for="name">Nombre</label>
										<input type="text" name="nombre" id="name" value="Nombre" />
									</div>
									<div class="field half">
										<label for="apellido">Apellido</label>
										<input type="text" name="apellido" id="apellido" value="Apellido" />
									</div>
									<div class="field half">
										<label for="dni">DNI</label>
										<input type="num" name="dni" id="dni" value="99000999" />
									</div>
									<div class="field half">
										<label for="tel">Teléfono</label>
										<input type="num" name="tel" id="tel" value="Solo números 5411000999" />
									</div>
									<div class="field half">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" value="" />
									</div>
									<div class="field">
										<label for="msj">Comentario</label>
										<textarea name="msj" id="msj" rows="6"></textarea>
									</div>
								</div>
								<!-- RECAPCHA -->
								<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
								<ul class="actions special">
									<li><input type="submit" name="submit" id="submit" value="Solicitar Informe" /></li>
								</ul>
							</form>

						</div>
					</section>
