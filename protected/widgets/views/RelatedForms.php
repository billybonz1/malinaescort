<div class="slider-box relatedForms" id="jsVipGirls">
    <div class="main-area">
        <div class="items">
            <ul>
                <?php foreach ($forms as $form):
                    if (!($img = $form->getRandomPhotoForHomePage('142x180'))) continue; ?>
                    <li>
                        <?= CHtml::link(htmlspecialchars($form->name, ENT_QUOTES), $form->generateURL(), array('class' => 'title')) ?>
                        <a href="<?= $form->generateURL(); ?>" class="photo">
                            <?= CHtml::image('#', $form->name_en, array('class' => 'formImage round', 'data-img' => $img, 'title' => $form->name_en)) ?>
                            <span class="info-box round">
                                <span class="indent-area">
                                    <span class="row"><?= L::t('Age') ?>: <span
                                            class="param"><?= $form->age ?></span></span>
                                    <span class="row"><?= L::t('Breast short:') ?> <span
                                            class="param"><?= $form->breast ?></span></span>
                                    <span class="row"><?= L::t('Rise') ?>: <span class="param"><?= $form->rise ?></span></span>
                                    <span class="row"><?= L::t('Price') ?>: <span
                                            class="param"><?= $form->price_hour ?></span></span>
                                </span>
                            </span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <a href="#" class="btn-slider prev">prev</a>
    <a href="#" class="btn-slider next">next</a>
</div>