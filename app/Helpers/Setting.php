<?php

function setting($key) {
  return \App\Models\Tools\Setting::getSetting($key);
}