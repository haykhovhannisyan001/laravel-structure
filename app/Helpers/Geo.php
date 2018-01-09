<?php

/**
 * Return a list of states ordered by state name
 * @return array
 */
function getStates($shortVersion=false) {
  $regions = getStatesByRegion();
  $list = [];
  foreach($regions as $region => $states) {
    foreach($states as $key => $value) {
      $list[$key] = $shortVersion ? $key : $value;
    }
  }
  asort($list);
  return $list;
}

function getStateByAbbr($abbr) {
  return getStates()[$abbr] ?? null;
}

function getTimeZoneList() {
  $timeZones = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');
  $list = array();
  foreach($timeZones as $timeZone) {
    $list[$timeZone] = $timeZone;
  }

  return $list;
}

function getAdjacentStates() {
  return array(
    'AK' => array(),
    'AL' => array('FL', 'GA', 'MS', 'TN'),
    'AR' => array('LA', 'MO', 'MS', 'OK', 'TN', 'TX'),
    'AZ' => array('CA', 'CO', 'NM', 'NV', 'UT'),
    'CA' => array('NV', 'OR', 'AZ'),
    'CO' => array('KS', 'NE', 'NM', 'OK', 'UT', 'WY'),
    'CT' => array('MA', 'NY', 'RI'),
    'DC' => array('MD', 'VA'),
    'DE' => array('MD', 'NJ', 'PA'),
    'FL' => array('GA', 'AL'),
    'GA' => array('AL', 'SC', 'TN', 'FL'),
    'HI' => array('HI'),
    'IA' => array('IL', 'MN', 'MO', 'NE', 'SD', 'WI'),
    'ID' => array('MT', 'NV', 'OR', 'UT', 'WA', 'WY'),
    'IL' => array('IN', 'KY', 'MO', 'WI', 'IA', 'MI'),
    'IN' => array('KY', 'MI', 'OH', 'IL'),
    'KS' => array('MO', 'NE', 'OK', 'CO'),
    'KY' => array('MO', 'OH', 'TN', 'VA', 'WV', 'IN', 'IL'),
    'LA' => array('MS', 'TX', 'AR'),
    'MA' => array('NH', 'NY', 'RI', 'VT', 'CT'),
    'MD' => array('PA', 'VA', 'WV', 'DE'),
    'ME' => array('NH'),
    'MI' => array('OH', 'WI', 'IL', 'IN'),
    'MN' => array('ND', 'SD', 'WI', 'IA'),
    'MO' => array('NE', 'OK', 'TN', 'KS', 'AR', 'KY', 'IL'),
    'MS' => array('TN', 'AL', 'AR', 'LA'),
    'MT' => array('ND', 'SD', 'WY', 'ID'),
    'NC' => array('SC', 'TN', 'VA'),
    'ND' => array('SD', 'MN', 'MT'),
    'NE' => array('SD', 'WY', 'CO', 'KS', 'MO'),
    'NH' => array('VT', 'MA', 'ME'),
    'NJ' => array('NY', 'PA'),
    'NM' => array('OK', 'TX', 'UT', 'CO', 'AZ'),
    'NV' => array('OR', 'UT', 'ID', 'CA', 'AZ'),
    'NY' => array('PA', 'VT', 'MA', 'CT', 'NJ'),
    'OH' => array('PA', 'WV', 'KY', 'IN', 'MI'),
    'OK' => array('TX', 'AR', 'MO', 'KS', 'CO', 'NM'),
    'OR' => array('WA', 'CA', 'NV', 'ID'),
    'PA' => array('WV', 'NJ', 'MD', 'NY', 'OH'),
    'RI' => array('CT', 'MA'),
    'SC' => array('NC', 'GA'),
    'SD' => array('WY', 'MT', 'ND', 'MN', 'IA', 'NE'),
    'TN' => array('VA', 'KY', 'NC', 'TN', 'MO', 'IL', 'IN', 'OH', 'WV'),
    'TX' => array('LA', 'AR', 'OK', 'NM'),
    'UT' => array('WY', 'CO', 'NM', 'AZ', 'NV', 'ID'),
    'VA' => array('WV', 'MD', 'KY', 'TN', 'NC'),
    'WA' => array('ID', 'OR'),
    'WV' => array('PA', 'MD', 'VA', 'KY', 'OH'),
    'WI' => array('MI', 'IL', 'IA', 'MN'),
    'WY' => array('MT', 'SD', 'NE', 'CO', 'UT', 'ID'),
  );
}


function getTimeZoneByState($state) {
  return getStateTimeZones()[$state] ?? null;
}

function getStateTimeZones() {
  return array(
    'AK' => 'America/Anchorage',
    'AL' => 'America/Chicago',
    'AR' => 'America/Chicago',
    'AZ' => 'America/Phoenix',
    'CA' => 'America/Los_Angeles',
    'CO' => 'America/Denver',
    'CT' => 'America/New_York',
    'DC' => 'America/New_York',
    'DE' => 'America/New_York',
    'FL' => 'America/New_York',
    'GA' => 'America/New_York',
    'HI' => 'Pacific/Honolulu',
    'IA' => 'America/Chicago',
    'ID' => 'America/Boise',
    'IL' => 'America/Chicago',
    'IN' => 'America/Indiana/Indianapolis',
    'KS' => 'America/Chicago',
    'KY' => 'America/Kentucky/Louisville',
    'LA' => 'America/Chicago',
    'MA' => 'America/New_York',
    'MD' => 'America/New_York',
    'ME' => 'America/New_York',
    'MI' => 'America/Detroit',
    'MN' => 'America/Chicago',
    'MO' => 'America/Chicago',
    'MS' => 'America/Chicago',
    'MT' => 'America/Denver',
    'NC' => 'America/New_York',
    'ND' => 'America/North_Dakota/Center',
    'NE' => 'America/Chicago',
    'NH' => 'America/New_York',
    'NJ' => 'America/New_York',
    'NM' => 'America/Denver',
    'NV' => 'America/Los_Angeles',
    'NY' => 'America/New_York',
    'OH' => 'America/New_York',
    'OK' => 'America/Chicago',
    'OR' => 'America/Los_Angeles',
    'PA' => 'America/New_York',
    'PR' => 'America/New_York',
    'RI' => 'America/New_York',
    'SC' => 'America/New_York',
    'SD' => 'America/Chicago',
    'TN' => 'America/Chicago',
    'TX' => 'America/Chicago',
    'UT' => 'America/Denver',
    'VA' => 'America/New_York',
    'WA' => 'America/Los_Angeles',
    'VT' => 'America/New_York',
    'WV' => 'America/New_York',
    'WI' => 'America/Chicago',
    'WY' => 'America/Denver',
  );
}

function getRegionsByStateAbbr($abbrState) {
  return getStateRegions()[$abbrState] ?? null;
}

/**
 * Return list of states grouped by region
 * @return array
 */
function getStateRegions() {
  return array(
    'CT' => 'Eastern',  
    'DE' => 'Eastern',  
    'DC' => 'Eastern',  
    'FL' => 'Eastern',  
    'GA' => 'Eastern', 
    'IN' => 'Eastern',  
    'KY' => 'Eastern',  
    'ME' => 'Eastern',  
    'MD' => 'Eastern',  
    'MA' => 'Eastern',  
    'MI' => 'Eastern', 
    'NH' => 'Eastern',
    'NJ' => 'Eastern',
    'NY' => 'Eastern',
    'NC' => 'Eastern',
    'OH' => 'Eastern', 
    'PA' => 'Eastern',  
    'PR' => 'Eastern',
    'RI' => 'Eastern',  
    'SC' => 'Eastern',
    'VI' => 'Eastern',
    'VT' => 'Eastern',  
    'VA' => 'Eastern',
    'WV' => 'Eastern',
    
    'AL' => 'Central',
    'AR' => 'Central', 
    'IL' => 'Central',
    'IA' => 'Central',  
    'KS' => 'Central', 
    'LA' => 'Central',
    'MN' => 'Central',  
    'MS' => 'Central',  
    'MO' => 'Central',  
    'NE' => 'Central',
    'ND' => 'Central',
    'OK' => 'Central', 
    'SD' => 'Central',
    'TN' => 'Central',  
    'TX' => 'Central',
    'WI' => 'Central',
    
    'CO' => 'Mountain',
    'ID' => 'Mountain',
    'MT' => 'Mountain',
    'NM' => 'Mountain',
    'UT' => 'Mountain',
    'WY' => 'Mountain',
    
    'AZ' => 'Pacific',
    'CA' => 'Pacific',
    'NV' => 'Pacific',
    'OR' => 'Pacific',
    'WA' => 'Pacific',
    
    'AK' => 'Alaska',
    'HI' => 'Hawaii',
  );
}

/**
 * Return list of states grouped by region
 * @return array
 */
function getStatesByRegion() {
  return array(
    'Eastern' => array( 
      'CT' => 'Connecticut',  
      'DE' => 'Delaware',  
      'DC' => 'District Of Columbia',  
      'FL' => 'Florida',  
      'GA' => 'Georgia', 
      'IN' => 'Indiana',  
      'KY' => 'Kentucky',  
      'ME' => 'Maine',  
      'MD' => 'Maryland',  
      'MA' => 'Massachusetts',  
      'MI' => 'Michigan', 
      'NH' => 'New Hampshire',
      'NJ' => 'New Jersey',
      'NY' => 'New York',
      'NC' => 'North Carolina',
      'OH' => 'Ohio', 
      'PA' => 'Pennsylvania',
      'PR' => 'Puerto Rico',
      'RI' => 'Rhode Island',  
      'SC' => 'South Carolina',
      'VI' => 'Virgin Islands',
      'VT' => 'Vermont',  
      'VA' => 'Virginia',
      'WV' => 'West Virginia',
    ),
    'Central' => array(
      'AL' => 'Alabama',
      'AR' => 'Arkansas', 
      'IL' => 'Illinois',
      'IA' => 'Iowa',  
      'KS' => 'Kansas', 
      'LA' => 'Louisiana',
      'MN' => 'Minnesota',  
      'MS' => 'Mississippi',  
      'MO' => 'Missouri',  
      'NE' => 'Nebraska',
      'ND' => 'North Dakota',
      'OK' => 'Oklahoma', 
      'SD' => 'South Dakota',
      'TN' => 'Tennessee',  
      'TX' => 'Texas',
      'WI' => 'Wisconsin',
    ),
    'Mountain' => array(
      'CO' => 'Colorado',
      'ID' => 'Idaho',
      'MT' => 'Montana',
      'NM' => 'New Mexico',
      'UT' => 'Utah',
      'WY' => 'Wyoming'
    ),
    'Pacific' => array(
      'AZ' => 'Arizona',
      'CA' => 'California',
      'NV' => 'Nevada',
      'OR' => 'Oregon',
      'WA' => 'Washington',
    ),
    'Other' => array(
      'AK' => 'Alaska',
      'HI' => 'Hawaii',
    ),
  );
}
function getStateKeys(){
  return implode(',',array_keys(getStates()));
}
function toDate($date,$format = 'Y-m-d H:m'){
    return \Carbon\Carbon::createFromTimestamp($date)->format($format);
}