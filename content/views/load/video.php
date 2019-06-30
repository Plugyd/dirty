<?
    use React\Core\Store;  
    Store::Prepare('SELECT name, id FROM category');
    Store::Execute();
    $data = Store::FetchAll();
?>
<div class="box">
	<div class="box_insideall">
		<div class="box_inside">
			<div class="title_form">Загрузка видео</div>
			<div class="input_box_inner">
				<div class="input_box">
					<label for="login_input" class="input_placeholder">Название</label>
					<input class="" autocomplete="off" id="namec" type="text">
				</div>
			</div>
			<div class="input_box_inner">
				<div class="input_box">
					<label for="password_input" class="input_placeholder">Описание</label>
					<textarea class="autosizes" autocomplete="off" id="desc"></textarea>
				</div>
			</div>
			<div class="input_box_inner">
				<div class="input_box">
					<label for="password_input" class="input_placeholder">URL видео</label>
					<input class="" autocomplete="off" id="urlv" type="text">
				</div>
			</div>
			<div class="input_box_inner">
				<div class="input_box">
					<label for="password_input" class="input_placeholder">Превью</label>
					<input class="" autocomplete="off" id="url" type="text">
				</div>
			</div>
			<div class="input_box_inner">
				<div class="input_box">
					<select name="select_box" id="cats">
					<? foreach ($data as $category) :?>
					<option value="<?=$category['id']?>"><?=$category['name']?></option>
                    <? endforeach;?>
					</select>
				</div>
			</div>

			<button type="submit" class="bt bt-reg" id="video">Загрузить</button>
			<div class="response-form-all">
				<div class="response-form"></div>
			</div>
		</div>
	</div>
	<div class="box_inside">
		<div class="title_form">Изображения</div>
		<button type="submit" class="bt bt-reg" id="winvideo">Загрузить изображение?</button>
	</div>
</div>