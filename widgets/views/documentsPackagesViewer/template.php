<?php
/* $this yii\web\View */
/* $data */
use yii\helpers\Url;

?>
<?
$nmbs=count($data);

$cols=3;
$rows=ceil($nmbs/$cols);
$index=0;
?>
<div class="row">
<div class="col-lg-12">
	<h1>Пакеты документов</h1>
</div>
<?for($c_ind=0;$c_ind<$cols;$c_ind++):?>
	<div class="col-lg-4">
    	<ul class="list-group">
    	<?for($r_ind=0;$r_ind<$rows;$r_ind++):?>
    		<?$index=$r_ind*$cols+$c_ind;?>
    		<?if($index>=$nmbs)break;?>
        	<li class="list-group-item">
        		<?=$index+1?> <?=$data[$index]['package']['active']?>
        		<?if($data[$index]['documents']):?>
        		<i class="glyphicon glyphicon-th-list package_toggle_button" 
            		style="cursor: pointer" 
            		target_id="package_docs_<?=$data[$index]['package']['id']?>">
        		</i>
        		<?endif;?>
        		<?=$data[$index]['package']['name']?> 
        		<a href="<?=Url::toRoute(['/iit-docs/documents-packages/entity-edit','entity_id'=>$data[$index]['package']['id']])?>"
    				target="_blank">(<?=$data[$index]['package']['id']?>)</a>
        		<?if($data[$index]['documents']):?>
            		<ul class="list-group" 
                		style="display:none;margin-top:20px" 
                		id="package_docs_<?=$data[$index]['package']['id']?>">
                		<?foreach($data[$index]['documents'] as $document):?>
                			<li class="list-group-item">
                				<?=$document['active']?> <?=$document['name']?>
                				<a href="<?=Url::toRoute(['/iit-docs/documents/entity-edit','entity_id'=>$document['id']])?>"
                					target="_blank">
                				(<?=$document['id']?>)
                				</a>
            				</li>
            			<?endforeach;?>
            		</ul>
        	<?endif;?>
        	</li>
    	<?endfor;?>
    	</ul>
	</div>
<?endfor;?>
</div>

<?
$js=<<<JS_CODE
$(".package_toggle_button").click(function(){
    console.log(this);
    var target_id="#"+$(this).attr('target_id');
    $(target_id).toggle();
});
JS_CODE;

$this->registerJs($js);
?>