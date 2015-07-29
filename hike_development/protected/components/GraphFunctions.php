<?php
// Created: 2014
// Modified: 25 jan 2015


/**
 *
 */
class GraphFunctions
{
    
        public static function getGraphTotaalScorePerGroup($event_id,
                                                       $group_id)
        {
                $criteria = new CDbCriteria;
                $criteria->condition="group_ID = $group_id AND
                                      event_ID = $event_id AND
                                      checked  = 1 AND
                                      correct  = 1";
                $data = OpenVragenAntwoorden::model()->findAll($criteria);
                $counter = 0;
                foreach($data as $obj)
                {
                        /* Score is opgeslagen als een interger, en dat kan de grafiek niet aan.
                         * Daarom moet de score eerst geconvert worden naar een float.
                         */
                        //$score = round((float)$obj->score, 2);
                        $score = OpenVragen::model()->getOpenVraagScore($obj->open_vragen_ID);
                        $scoreArray[$counter][0] = strtotime($obj->create_time);
                        $scoreArray[$counter][1] = $score;
                        $counter++;
                }
                
                $criteria = new CDbCriteria;
                $criteria->condition="group_ID = $group_id AND
                                      event_ID = $event_id AND
                                      gepasseerd  = 1";
                $data = PostPassage::model()->findAll($criteria);
           
                foreach($data as $obj)
                {
                        /* Score is opgeslagen als een interger, en dat kan de grafiek niet aan.
                         * Daarom moet de score eerst geconvert worden naar een float.
                         */
                        //$score = round((float)$obj->score, 2);
                        $score = Posten::model()->getPostScore($obj->post_ID);
                        $scoreArray[$counter][0] = strtotime($obj->create_time);
                        $scoreArray[$counter][1] = $score;
                        $counter++;
                }                
                
                $criteria = new CDbCriteria;
                $criteria->condition="group_ID = $group_id AND
                                      event_ID = $event_id AND
                                      opened  = 1";
                $data = OpenNoodEnvelop::model()->findAll($criteria);
           
                foreach($data as $obj)
                {
                        /* Score is opgeslagen als een interger, en dat kan de grafiek niet aan.
                         * Daarom moet de score eerst geconvert worden naar een float.
                         */
                        //$score = round((float)$obj->score, 2);
                        $score = NoodEnvelop::model()->getNoodEnvelopScore($obj->nood_envelop_ID);
                        $scoreArray[$counter][0] = strtotime($obj->create_time);
                        $scoreArray[$counter][1] = -$score;
                        $counter++;
                }
                
                $criteria = new CDbCriteria;
                $criteria->condition="group_ID = $group_id AND
                                      event_ID = $event_id";
                $data = QrCheck::model()->findAll($criteria);
           
                foreach($data as $obj)
                {
                        /* Score is opgeslagen als een interger, en dat kan de grafiek niet aan.
                         * Daarom moet de score eerst geconvert worden naar een float.
                         */
                        //$score = round((float)$obj->score, 2);
                        $score = Qr::model()->getQrScore($obj->qr_ID);
                        $scoreArray[$counter][0] = strtotime($obj->create_time);
                        $scoreArray[$counter][1] = $score;
                        $counter++;
                }
                
                $criteria = new CDbCriteria;
                $criteria->condition="group_ID = $group_id AND
                                      event_ID = $event_id";
                $data = Bonuspunten::model()->findAll($criteria);
           
                foreach($data as $obj)
                {
                        /* Score is opgeslagen als een interger, en dat kan de grafiek niet aan.
                         * Daarom moet de score eerst geconvert worden naar een float.
                         */
                        $score = round((float)$obj->score, 2);
                        $scoreArray[$counter][0] = strtotime($obj->create_time);
                        $scoreArray[$counter][1] = $score;
                        $counter++;
                }
                
                if(isset($scoreArray))
                {
                    sort($scoreArray);
                  
                    $counter = 0;
                    $temp_score = 0;
                    foreach($scoreArray as $obj)
                    {
                            $score = $temp_score + $obj[1];
                            /* Time stamp moet vermedigvuldigd worden met 1000, voordat
                             * tijd compatible is met javascript tijd.
                             */
                            $tempArray[$counter][0] = $obj[0]*1000;
                            $tempArray[$counter][1] = $score;
                            $temp_score = $score;
                            $counter++;
                    }
                
                return $tempArray;
                }
        }
        
        public static function getGraphScoreForVragenPerGroup($event_id,
                                                       $group_id)
        {
                $criteria = new CDbCriteria;
                $criteria->condition="group_ID = $group_id AND
                                      event_ID = $event_id AND
                                      checked  = 1 AND
                                      correct  = 1";
                $data = OpenVragenAntwoorden::model()->findAll($criteria);
                $counter = 0;
                $temp_score = 0;
                foreach($data as $obj)
                {
                        /* Score is opgeslagen als een interger, en dat kan de grafiek niet aan.
                         * Daarom moet de score eerst geconvert worden naar een float.
                         */
                        $score = round((float)$obj->score, 2);
                        $score = $temp_score + $score;
                        $scoreArray[$counter][0] = strtotime($obj->create_time);
                        $scoreArray[$counter][1] = $score;
                        $temp_score = $score;
                        $counter++;
                }
                return $scoreArray;
        }

        public static function getGraphScoreForPostenPerGroup($event_id,
                                                       $group_id)
        {
                $criteria = new CDbCriteria;
                $criteria->condition="group_ID = $group_id AND
                                      event_ID = $event_id AND
                                      gepasseerd  = 1";
                $data = PostPassage::model()->findAll($criteria);
                $counter = 0;
                $temp_score = 0;
                foreach($data as $obj)
                {
                        /* Score is opgeslagen als een interger, en dat kan de grafiek niet aan.
                         * Daarom moet de score eerst geconvert worden naar een float.
                         */
                        $score = round((float)$obj->score, 2);
                        $score = $temp_score + $score;
                        $scoreArray[$counter][0] = strtotime($obj->create_time);
                        $scoreArray[$counter][1] = $score;
                        $temp_score = $score;
                        $counter++;
                }
                return $scoreArray;
        }
}

                        

