<?php $email_marketing = get_option( 'email_marketing' ); ?> <!-- Carrega a aba email_marketing -->

		<div id="form-widget" class="text-center">

			<form method="POST" action="<?php echo $email_marketing['action']; ?>" target="new">					
			<input type="email" name="<?php echo $email_marketing['name_email']; ?>" placeholder="<?php echo $email_marketing['texto_campo_email']; ?>" class="form-control input-md" required>
			<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_01']; ?>" value="<?php echo $email_marketing['valor_input_extra_01']; ?>">									
			<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_02']; ?>" value="<?php echo $email_marketing['valor_input_extra_02']; ?>">									
			<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_03']; ?>" value="<?php echo $email_marketing['valor_input_extra_03']; ?>">									
			<input type="hidden" name="<?php echo $email_marketing['nome_input_extra_04']; ?>" value="<?php echo $email_marketing['valor_input_extra_04']; ?>">									
						
			<button type="submit" class="btn-info botao-captura"><?php echo $email_marketing['texto_botao']; ?></button>				
			</form>
				<hr>
			<p align="center"><?php echo $email_marketing['texto_spam']; ?></p>
		</div>

</div> <!-- Fecha a div aberta no core/widgets/captura.php -->