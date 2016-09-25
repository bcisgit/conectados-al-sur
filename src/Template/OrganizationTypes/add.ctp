<!-- Available Actions -->
<?php $this->start('available-actions'); ?>
<?php $this->end(); ?>

<!-- Page Content -->
<div class="fullwidth page-content">

<div class="row">
    <div class="small-12 columns">
        <div class="form">
            <h4 class="view-subtitle"><?= __('New Organization Type:') ?></h4>
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create($organizationType) ?>
            
            <?= $this->Form->input('name', [
                    'label' => 'Organization Type Name',
                    'placeholder' => 'United Nations',
                    'type'        => 'text',
                    'required'
                ]) ?>
                
            <?= $this->Form->input('name_es', [
                    'label' => 'Organization Type Name (Spanish)',
                    'placeholder' => 'Naciones Unidas',
                    'type'        => 'text',
                    'required']) ?>

            <!-- submit, cancel -->
            <div class="row">
                <div class="small-12 columns">
                    <?= $this->Form->button(__('Submit'), ['class' => 'warning button']) ?>
                </div>
                <div class="small-12 columns">
                    <a href=<?= $this->Url->build(['controller' => 'Instances', 'action' => 'view', $instance->namespace]) ?> class="alert hollow button">CANCEL</a>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
</div>

<style type="text/css">
a.button.alert {
    font-size: 18px;
    float: right;
}
</style>