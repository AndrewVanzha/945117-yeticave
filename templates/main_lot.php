</html>
<nav class="nav">
    <ul class="nav__list container">
      <?php foreach ($item_type as $value): ?>
        <li class="nav__item">
            <a href="all-lots.html">
              <?php print(strip_tags($value)); ?>
            </a>
        </li>
      <?php endforeach; ?>
    </ul>
</nav>
<section class="lot-item container">
    <?php if(isset($item_table[0]['item'])): ?>
      <h2><?php strip_tags($item_table[0]['item']); ?></h2>
    <?php endif; ?>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
              <?php if(isset($item_table[0]['pic']) && isset($item_table[0]['item'])): ?>
                <img src="<?=strip_tags($item_table[0]['pic']); ?>" width="730" height="548" alt="<?=strip_tags($item_table[0]['item']); ?>">
              <?php endif; ?>
            </div>
            <p class="lot-item__category">Категория: 
              <span>
                <?php if(isset($item_table[0]['category'])) { echo strip_tags($item_table[0]['category']); } ?>
              </span>
            </p>
            <p class="lot-item__description">
              <?php if(isset($item_table[0]['description'])) { echo strip_tags($item_table[0]['description']); } ?>
  <!--          Легкий маневренный сноуборд, готовый дать жару в любом парке,
                растопив
                снег
                мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях,
                наделяет этот
                снаряд
                отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим
                прогибом
                кэмбер
                позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не
                останется,
                просто
                посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не
                оставляла
                равнодушным.-->
            </p>
        </div>
        <div class="lot-item__right">
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                <?php printf("%d:%02d", $wait_time[0], $wait_time[1]); ?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <?php if(isset($item_table[0]['curr_price'])): ?>
                          <span class="lot-item__cost"><?=strip_tags(yeti_sum($item_table[0]['curr_price'])); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?=strip_tags($item_table[0]['curr_price']+$item_table[0]['bid_inc']); ?> &#8381;</span>
                    </div>
                </div>
                <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post">
                    <p class="lot-item__form-item form__item form__item--invalid">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="text" name="cost" placeholder="12 000">
                        <span class="form__error">Введите наименование лота</span>
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <div class="history">
                <h3>История ставок (<span>10</span>)</h3>
                <table class="history__list">
                    <tr class="history__item">
                        <td class="history__name">Иван</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">5 минут назад</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Константин</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">20 минут назад</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Евгений</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">Час назад</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Игорь</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">19.03.17 в 08:21</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Енакентий</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">19.03.17 в 13:20</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Семён</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">19.03.17 в 12:20</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Илья</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">19.03.17 в 10:20</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Енакентий</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">19.03.17 в 13:20</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Семён</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">19.03.17 в 12:20</td>
                    </tr>
                    <tr class="history__item">
                        <td class="history__name">Илья</td>
                        <td class="history__price">10 999 р</td>
                        <td class="history__time">19.03.17 в 10:20</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

</html>
