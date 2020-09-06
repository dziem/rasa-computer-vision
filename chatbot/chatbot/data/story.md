## first story
* greet
 - utter_greet
* ask_help_baca_gambar
 - utter_ask_image
* inform_image{"image": "image.png"} OR inform_image{"image": "image.jpg"}
 - slot{"image_path": "image.png"}
 - action_baca_gambar
 - slot{"image_path": "image.png"}
* thanks
 - utter_thanks
 
## second story
* greet
 - utter_greet
* ask_help_scan_gambar
 - utter_ask_image
* inform_image{"image": "image.png"} OR inform_image{"image": "image.jpg"}
 - slot{"image_path": "image.png"}
 - action_scan_gambar
 - slot{"image_path": "image.png"}
* thanks
 - utter_thanks