				<!-- Informes -->
					<section class="wrapper style1 align-center">
						<div class="inner medium">
							<h2>Solicitar informe VERAZ</h2>
							<form method="post" action="./checkform" autocomplete="off">
								<div class="fields">
									<div class="field half">
										<label for="name">Nombre</label>
										<input type="text" name="nombre" id="name" placeholder="Nombre" required autofocus />
									</div>
									<div class="field half">
										<label for="apellido">Apellido</label>
										<input type="text" name="apellido" id="apellido" placeholder="Apellido" required />
									</div>
									<div class="field half">
										<label for="dni">DNI</label>
										<input type="number" name="dni" id="dni" placeholder="99000999" maxlength="9" required />
									</div>
									<div class="field half">
										<label for="tel">Teléfono</label>
										<input type="number" name="tel" id="tel" placeholder="1100009999" maxlength="11" required />
									</div>
									<div class="field half">
										<label for="email">Email</label>
										<input type="email" name="email" id="email" placeholder="email@email.com" required />
									</div>
									<div class="field">
										<label for="msj">Comentario</label>
										<textarea name="msj" id="msj" rows="6" placeholder="Datos que aclaren su situación crediticia"  required></textarea>
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
