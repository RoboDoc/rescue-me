<?php

    /**
     * File containing: Delivery interface
     * 
     * @copyright Copyright 2013 {@link http://www.discoos.org DISCO OS Foundation} 
     *
     * @since 12. July 2013
     * 
     * @author Sven-Ove Bjerkan <post@sven-ove.no>
     */
    
    namespace RescueMe\SMS;

    /**
     * Provider class
     * 
     * @package 
     */
    interface Delivery
    {       
        /**
         * Register that a message has been delivered.
         * 
         * @param string $to Recipient phone number
         * @param bool $status Deliverystatus
         * @param string $errorDesc Error description
         * 
         */
        public function delivered($provider_ref,$to,$status,$errorDesc);
        
    }// Provider
