<?php
// Created: 2014
// Modified: 26 jan 2015

/* @var $this PostPassageController */
/* @var $data PostPassage */
?>

<div class="view">
    <table>
        <td>
          <?php
              if(PostPassage::model()->isActionAllowed('postPassage', 'update', $data->event_ID) and !$data->vertrek)
              {		
                      echo CHtml::link('<span class="fa-stack fa-lg">
                                          <i class="fa fa-circle fa-stack-2x fa-green"></i>
                                          <i class="fa fa-flag-o fa-stack-1x"></i>
                                          <i class="fa fa-blue fa-text-right fa-09x"> Vertrek Post</i>
                                          <i class="fa fa-angle-double-up fa-stack-up-15p fa-blue fa-06x"> </i>
                                      </span>', 
                                      array('postPassage/updateVertrek',
                                            'id'=>$data->posten_passage_ID,
                                            'event_id'=>$data->event_ID));
              }
            ?>
          <br />    
      
          <b><?php echo CHtml::encode($data->getAttributeLabel('post_ID')); ?>:</b>
          <?php echo CHtml::encode(Posten::model()->getPostName($data->post_ID));?>
          <br />

          <b><?php echo CHtml::encode('date'); ?>:</b>
          <?php echo CHtml::encode(Posten::model()->getDatePost($data->post_ID));  ?>
          <br />
      
          <b><?php echo CHtml::encode($data->getAttributeLabel('group_ID')); ?>:</b>
          <?php echo CHtml::encode(Groups::model()->getGroupName($data->group_ID));?>
          <br />
      
          <b><?php echo CHtml::encode($data->getAttributeLabel('gepasseerd')); ?>:</b>
          <?php echo CHtml::encode(GeneralFunctions::getJaNeeText($data->gepasseerd));?>
          
        </td>
        <td>
          
          <b><?php echo CHtml::encode($data->getAttributeLabel('binnenkomst')); ?>:</b>
          <?php echo CHtml::encode($data->binnenkomst); ?>
          <br />
      
          <b><?php echo CHtml::encode($data->getAttributeLabel('vertrek')); ?>:</b>
          <?php echo CHtml::encode($data->vertrek); ?>
          <br />
      
          <b><?php echo CHtml::encode('Score'); ?>:</b>
          <?php echo CHtml::encode(Posten::model()->getPostScore($data->post_ID)); ?>
          <br />
      
          <b><?php echo CHtml::encode($data->getAttributeLabel('create_user_ID')); ?>:</b>
          <?php echo CHtml::encode(Users::model()->getUserName($data->create_user_ID)); ?>
          <br />
           
          <b><?php echo CHtml::encode($data->getAttributeLabel('update_user_ID')); ?>:</b>
          <?php echo CHtml::encode(Users::model()->getUserName($data->update_user_ID)); ?>
          <br />
        </td>
    </table>
</div>