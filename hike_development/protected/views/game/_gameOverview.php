<?php
/* @var $this GroupsController */
/* @var $data Groups */
?>

<div class="view">
      <table >
			<tr>
				  <td colspan="4" style="text-align:center; height:40px">								 
						<div style="font-family:verdana; font-size:23px;">
							  <b><?php echo CHtml::encode($data->group_name); ?></b><sup>
							  <?php echo CHtml::link('<i class="fa fa-search-plus fa-inverse"></i>',
										 array('groupOverview',
										   'event_id'=>$data->event_ID,
										   'group_id'=>$data->group_ID)); ?></sup></div>
						
				  </td>
			</tr>
			<tr>
				  <td colspan="4" style="text-align:center;">
						<b><?php echo CHtml::encode('Laatste post'); ?>: </b>		
						<?php echo CHtml::encode(Posten::model()->getPostName(PostPassage::model()->getLaatstePostPassageNaam($data->event_ID,
																			  $data->group_ID)));?>		
				  </td>
			</tr>
			<tr>
				  <td colspan="4" style="text-align:center;">
						<b><?php echo CHtml::encode('Tijd laatste post'); ?>:</b>		
						<?php echo CHtml::encode(PostPassage::model()->getLaatstePostPassageTijd($data->event_ID,
															 $data->group_ID)); ?>
				
				  </td>
			</tr>
            <?php 
                if (EventNames::model()->maxTimeSet($data->event_ID)){
                    if (PostPassage::model()->timeLeftToday($data->event_ID, $data->group_ID)) { ?>  
                        <tr>
                            <td colspan="4" style="text-align:center;">
                                <b><?php echo CHtml::encode('Tijd over (minuten)'); ?>:</b>		
                                <?php echo CHtml::encode(PostPassage::model()->timeLeftToday($data->event_ID,
                                                                     $data->group_ID)); ?>
                          
                            </td>
                        </tr>
            <?php   } else { ?>
                        <tr>
                              <td colspan="4" style="text-align:center;">
                                    <b><?php echo CHtml::encode('De tijd is om voor vandaag!'); ?></b>		
                                              </td>
                        </tr>
            <?php   }
                } ?>			
			<tr>
			      	  <td style="text-align:right">	
						<?php echo CHtml::encode('Score Posten'); ?>		
				  </td>
				  <td>
						<?php echo CHtml::encode(PostPassage::model()->getPostScore($data->event_ID,
													 $data->group_ID)); ?>
					 
				  </td>
				  <td style="text-align:right">
						<?php echo CHtml::encode(QrCheck::model()->getQrScore($data->event_ID,
													  $data->group_ID)); ?>
		 
				  </td>
				  <td style="text-align:left">
						<?php echo CHtml::encode('Score Stille Posten'); ?>	
				  </td>
			</tr>
			<tr>
				  <td style="text-align:right">
						 <?php echo CHtml::encode('Score Vragen'); ?>		
				  </td>
				  <td>
						 <?php echo CHtml::encode(OpenVragenAntwoorden::model()->getOpenVragenScore($data->event_ID,
																$data->group_ID)); ?>
		 
				  </td>
				  <td style="text-align:right">
						 <?php echo CHtml::encode(Bonuspunten::model()->getBonuspuntenScore($data->event_ID,
															$data->group_ID)); ?>
					 
				  </td>
				  <td style="text-align:left">
						 <?php echo CHtml::encode('Score Bonuspunten'); ?>		
				  </td>
			</tr>
			<tr>
				  <td style="text-align:right">
					 <?php echo CHtml::encode('Strafpunten Hints'); ?>
				  </td>
				  <td style="text-align:left">
					 <?php echo CHtml::encode(OpenNoodEnvelop::model()->getOpenEnvelopScore($data->event_ID,
															$data->group_ID)); ?>	 
			 
				  </td>
						  <td style="text-align:right">			
				  </td>
				  <td>
				  </td>	
			</tr>
			<tr>
				  <td style="text-align:right">	
				  </td>
				  <td>
				  </td>
				  <td style="text-align:right">
					 <?php echo CHtml::encode(Groups::model()->getTotalScoreGroup($data->event_ID,
												  $data->group_ID)); ?></b>
					 
				  </td>
				  <td style="text-align:left">
						<b><?php echo CHtml::encode('Totaal Score'); ?>: </b>	
				  </td>
			</tr>
			<tr>
				  <td colspan="4" style="text-align:center; font-size:220%"">
						<span class="fa-stack fa-lg">
							  <i class="fa fa-circle fa-stack-2x fa-gold"></i>
							  <i class="fa fa-trophy fa-stack-1x fa-inverse"></i>
							  <i class="fa fa-stack-30p fa-blue fa-05x">
									<?php echo Groups::model()->getRankGroup($data->event_ID,
														 $data->group_ID) ?>
							  </i>
						</span>						
				  </td>
				  
			</tr>
      </table>
</div>