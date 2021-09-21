<?php
require_once __DIR__ . '/view/header.php';
?>
<div class="container">
		<br>
		<hr>
		<div class="container">
			<form action="input.php" method="post">
				<div class="row">
					<div class="col-md-3 ticket-form">
						<div class="mb-3">
							<input class="form-control form-control-lg" name="title" type="text" placeholder="Название задачи" aria-label=".form-control-lg example">
						</div>
						<div class="mb-3">
							<textarea class="form-control form-control-lg" name="desc" id="exampleFormControlTextarea1" rows="3" placeholder="Описание задачи"></textarea>
						</div>

						<div class="mb-3">
							<div class="accordion" id="accordionExample">
								<div class="accordion-item">
									<h2 class="accordion-header" id="headingOne">
										<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Напоминание по дате
										</button>
									</h2>
									<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
										<div class="accordion-body">
											<h1><input class="form-control form-control-lg" type="datetime-local" id="localdate" name="date"/></h1>
										</div>
									</div>
								</div>
								<div class="accordion-item">
									<h2 class="accordion-header" id="headingTwo">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											Напоминание по дням недели
										</button>
									</h2>
									<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
										<div class="accordion-body">
											<strong>Напоминание по дням недели.</strong>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<button type="submit" name="submit" class="btn btn-primary mb-3">Отправить тикет</button>
						</div>

					</div>

					<div class="col-md-9">
						<?php
						echo '<h3>Сейчас: '.date("d.m.Y H:i").'</h3>';
						var_dump($connectDatabaase->expired_ticket());
foreach ($connectDatabaase->expired_ticket() as $value) {
    ?>
							<div class="card text-white bg-danger mb-3">
								<div class="card-body">
									<h5 class="card-title"><?=$value['title'];?></h5>
									<p class="card-text"><?=$value['desc'];?></p>
									<p><?=str_replace('T', ' ', date('Y-m-d H:i', $value['date']));?></p>
								</div>
							</div>
							<?php
}
$connectDatabaase->send_tg_ticket();
?>
					</div>
				</form>
			</div>
			<hr>
			<div class="container">
				<div class="row">
					<?php
foreach ($connectDatabaase->get_ticket() as $value) {
    ?>
						<div class="col-md-3">
							<div class="card text-white bg-<?=$value['ticket_status'];?> mb-3">
								<form method="post" action="input.php"><button type="submit" name="delete" class="btn" aria-label="Close" value="<?=$value['id'];?>">Удалить</button>
									<?php if ($value['ticket_status'] == 'primary') {?>
										<input type="hidden" name="status-ticket" value="warning">
										<button type="submit" name="important" class="btn" value="<?=$value['id'];?>">Важно</button>
									<?php } else {?>
										<input type="hidden" name="status-ticket" value="primary">
										<button type="submit" name="important" class="btn" value="<?=$value['id'];?>">Неважно</button>
									<?php }?>
								</form>
								<div class="card-body">
									<h5 class="card-title"><?=$value['title'];?></h5>
									<p class="card-text">
										<?=mb_strimwidth($value['desc'], 0, 100, " ...");?>
									</p>
									<p><?=str_replace('T', ' ', date('Y-m-d H:i', $value['date']));?></p>
									<p><button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$value['id'];?>">Читать 🤯</button></p>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal fade" id="exampleModal<?=$value['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"><?=$value['title'];?></h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<?=$value['desc'];?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Save changes</button>
									</div>
								</div>
							</div>
						</div>
						<?php
}
?>
				</div>
			</div>


		</div>

		<?php
require_once __DIR__ . '/view/footer.php';
?>