</html>
<nav class="nav">
    <ul class="nav__list container">
      <?php foreach ($item_type as $value): ?>
        <li class="nav__item">
            <a href="all-lots.html">
              <?=(strip_tags($value)); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</nav>
<!--<form class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data" enctype="application/x-www-form-urlencoded">-->
<form name="add-file-form" class="form form--add-lot container <?=$field_errors['form-invalid']; ?>" action="add.php" method="post" enctype="multipart/form-data">
    <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item form__item--invalid">
            <!-- form__item--invalid -->
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?php print($form_values['lot-name']); ?>" required>
            <?php if (isset($field_errors['lot-name'])): ?>
              <span class="form__error-red"><?php print($field_errors['lot-name']); ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item">
            <label for="category">Категория</label>
            <select id="category" name="category" required>
              <?php foreach ($item_type as $value): ?>
                <option>
                  <?=(strip_tags($value)); ?>
                </option>
              <?php endforeach; ?>
            </select>
            <?php if (isset($field_errors['category'])): ?>
              <span class="form__error-red"><?php print($field_errors['category']); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="form__item form__item--wide">
        <label for="message">Описание</label>
        <textarea id="message" name="message" placeholder="Напишите описание лота" value="<?php print($form_values['message']); ?>" required></textarea>
        <?php if (isset($field_errors['message'])): ?>
          <span class="form__error-red"><?php print($field_errors['message']); ?></span>
        <?php endif; ?>
    </div>
    <div class="form__item form__item--file">
        <!-- form__item--uploaded -->
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input type="hidden" name="MAX_FILE_SIZE" value="50000">
            <input class="visually-hidden" name="file-name" type="file" id="photo2" value="send" required>
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?php print($form_values['lot-rate']); ?>" required>
            <?php if (isset($field_errors['lot-rate'])): ?>
              <span class="form__error-red"><?php print($field_errors['lot-rate']); ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item form__item--small">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?php print($form_values['lot-step']); ?>" required>
            <?php if (isset($field_errors['lot-step'])): ?>
              <span class="form__error-red"><?php print($field_errors['lot-step']); ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item">
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?php print($form_values['lot-date']); ?>" required>
            <?php if (isset($field_errors['lot-date'])): ?>
              <span class="form__error-red"><?php print($field_errors['lot-date']); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <!--<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>-->
    <button type="submit" class="button">Добавить</button>
</form>

</html>