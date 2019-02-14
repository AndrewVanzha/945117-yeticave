<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное
        снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($item_type as $value): ?>
        <li class="promo__item promo__item--boards">
            <a class="promo__link" href="pages/all-lots.html">
                <?php print(strip_tags($value)); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($item_table as $key => $value): ?>
        <li class="lots__item lot">
            <div class="lot__image">
                <?php if(isset($value['URL']) && isset($value['Name'])): ?>
                <img src="<?=strip_tags($value['URL']); ?>" width="350" height="260" alt="<?=strip_tags($value['Name']); ?>">
                <?php endif; ?>
            </div>
            <div class="lot__info">
                <span class="lot__category">Название категории</span>
                <?php if(isset($value['Category'])) { echo strip_tags($value['Category']); } ?>
                <h3 class="lot__title">
                    <a class="text-link" href="pages/lot.html">
                        <?php if(isset($value['Name'])) { echo strip_tags($value['Name']); } ?>
                    </a>
                </h3>
                <div class="lot__state">
                    <div class="lot__rate">
                        <span class="lot__amount">Стартовая цена</span>
                        <?php if(isset($value['Price'])): ?>
                        <span class="lot__cost">
                            <?=strip_tags(yetisum($value['Price'])); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="lot__timer timer">
                        12:23
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</section>
