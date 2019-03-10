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
<form name="add-file-form" class="form form--add-lot container form--invalid" action="add.php" method="post" enctype="multipart/form-data">
    <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item form__item--invalid">
            <!-- form__item--invalid -->
            <label for="lot-name">Наименование</label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$l_name;?>" required>
            <span class="form__error">Введите наименование лота</span>
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
            <span class="form__error">Выберите категорию</span>
        </div>
    </div>
    <div class="form__item form__item--wide">
        <label for="message">Описание</label>
        <textarea id="message" name="message" placeholder="Напишите описание лота" value="<?=$i_msg;?>" required></textarea>
        <span class="form__error">Напишите описание лота</span>
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
            <input type="hidden" name="MAX_FILE_SIZE" value="<?=$max_pic;?>">
            <input class="visually-hidden" name="file-name" type="file" id="photo2" value="send" required>
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small">
            <label for="lot-rate">Начальная цена</label>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$l_rate;?>" required>
            <span class="form__error">Введите начальную цену</span>
        </div>
        <div class="form__item form__item--small">
            <label for="lot-step">Шаг ставки</label>
            <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$l_step;?>" required>
            <span class="form__error">Введите шаг ставки</span>
        </div>
        <div class="form__item">
            <label for="lot-date">Дата окончания торгов</label>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$l_date;?>" required>
            <span class="form__error">Введите дату завершения торгов</span>
        </div>
    </div>
    <!--<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>-->
    <button type="submit" class="button">Добавить</button>
</form>

</html>