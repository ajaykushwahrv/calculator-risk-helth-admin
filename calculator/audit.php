<div class="">
    <p class="text-center"> <?php if(!empty($config['rvuserinfo']['mfarnDate'])){ ?><b><?=  $config['rvuserinfo']['websitename'] ?></b> </br><?php } ?> 
    <?php if(!empty($config['rvuserinfo']['mfarnDate'])){ ?>
         
            <b><?=  $config['rvuserinfo']['mfarnDate'] ?></b></br>
         
    <?php } ?>
    <?php if(!empty($config['rvuserinfo']['apmiDate'])){ ?>
         
            <b><?=  $config['rvuserinfo']['apmiDate'] ?></b></br>
         
    <?php } ?>
    <?php if(!empty($config['rvuserinfo']['irdaiDate'])){ ?>
 
            <b><?=  $config['rvuserinfo']['irdaiDate'] ?></b></br>
        
    <?php } ?>

</p>

    <div class="legal-links text-center   mt-2 mb-2">
        <?php foreach($rvasallaudits as  $key =>  $linkitems){ if ( $linkitems['id'] == 15) { continue; }?>
        <a class=" " href="<?= $linkitems['rvasurl'] ?>"
            <?= !empty($linkitems['target']) ? 'target="' . $linkitems['target'] .'"' : '' ?>><?= $linkitems['title'] ?></a>
        <?php if($key < count($rvasallaudits) - 1): ?> | <?php endif; ?>
        <?php } ?>
    </div>


    <p style="--rvcfo-color:var(--rv-white);  text-align:center;">
        <small>
            <?=  rv_fetchDynamic('audit-content', $config_data); ?>

            <?php if(!empty($config['rvuserinfo']['apmiDate'])){ ?><span>Portfolio Management Services are subject to market risks. Please read the Disclosure Document of the PMS provider carefully before investing. Past performance is not indicative of future returns.</span><?php } ?>

            <?php if(!empty($config['rvuserinfo']['irdaiDate'])){ ?><span>Insurance products are subject to the terms and conditions of the respective insurer. Please read all policy-related documents carefully before purchasing.</span><?php } ?>

            <?php if(!empty($config['rvuserinfo']['aif'])){ ?><span>Alternative Investment Funds are subject to market risks. Please read all scheme-related documents carefully before investing. Past performance is not indicative of future returns.</span><?php } ?>

            <?php if(!empty($config['rvuserinfo']['sif'])){ ?><span>Specialised Investment Funds are subject to market risks. Please read all related documents carefully before investing. Past performance is not indicative of future returns.</span><?php } ?>
            <?php if(!empty($config['rvuserinfo']['giftcity'])){ ?><span>Investments through GIFT City or offshore platforms are subject to applicable regulations, currency risks, and tax implications. Please read all related documents carefully before investing.</span><?php } ?></br>
    
        <b>We are not a SEBI Registered Investment Adviser. We distribute financial products and do not provide investment advisory services.</b></br>
        <?php if(!empty($config['rvuserinfo']['gstin'])){ ?><?= '<b>GSTIN:</b> ' . $config['rvuserinfo']['gstin'] . ' | '?><?php } ?>
        <?= !empty($config['rvuserinfo']['address']) ? '<b>Office:</b> ' . $config['rvuserinfo']['address'] : '' ?>
        </br>    
        <b>Grievance Redressal Officer: </b>
        <?= !empty($config['rvuserinfo']['clientname']) ? $config['rvuserinfo']['clientname'] : '' ?>
        <?= !empty($config['rvuserinfo']['email']) ? ' | <a href="tel:+91' .$config['rvuserinfo']['email']. '">' .$config['rvuserinfo']['email']. '</a>' : '' ?>
        <?= !empty($config['rvuserinfo']['mobile']) ? ' | <a href="tel:+91' .$config['rvuserinfo']['mobile']. '">' .$config['rvuserinfo']['mobile']. '</a>' : '' ?>
        </small>

    </p>

    <div><?=  rv_fetchDynamic('amfimfsh-img', $config_data); ?></div>
</div>