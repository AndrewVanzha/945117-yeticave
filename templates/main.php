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
                <?php if(isset($value['pic']) && isset($value['item'])): ?>
                <img src="<?=strip_tags($value['pic']); ?>" width="350" height="260" alt="<?=strip_tags($value['item']); ?>">
                <?php endif; ?>
            </div>
            <div class="lot__info">
                <span class="lot__category">Название категории</span>
                <?php if(isset($value['category'])) { echo strip_tags($value['category']); } ?>
                <h3 class="lot__title">
                    <a class="text-link" href="lot.php?id=<?php if(isset($value['id'])) {echo $value['id'];} ?>">
                        <?php if(isset($value['item'])) { echo strip_tags($value['item']); } ?>
                    </a>
                </h3>
                <div class="lot__state">
                    <div class="lot__rate">
                        <span class="lot__amount">Стартовая цена</span>
                        <?php if(isset($value['init_price'])): ?>
                        <span class="lot__cost">
                            <?=strip_tags(yeti_sum($value['init_price'])); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="lot__timer timer">
                        <?php printf("%d:%02d", $wait_time[0], $wait_time[1]); ?>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</section>