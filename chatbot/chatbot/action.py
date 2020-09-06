from rasa_core_sdk import Action
try:
    from PIL import Image
except ImportError:
    import Image
import os
import pytesseract
from imageai.Detection import ObjectDetection
from imageai.Prediction.Custom import CustomImagePrediction

class ActionBacaGambar(Action):
	def name(self):
		return 'action_baca_gambar'
	
	def run(self, dispatcher, tracker, domain):
		path = tracker.get_slot('image')
		tesseract_cmd = r'C:\Program Files\Tesseract-OCR'
		image_path = os.path.join(os.getcwd(), "img")
		response = pytesseract.image_to_string(Image.open(os.path.join(image_path , path)))
		dispatcher.utter_message(response)
		return[]
		
class ActionScanGambar(Action):
	def name(self):
		return 'action_scan_gambar'
	
	def run(self, dispatcher, tracker, domain):
		path = tracker.get_slot('image')
		image_path = os.path.join(os.getcwd(), "img")
		newfile = "new" + str(path)
		execution_path = os.getcwd()

		detector = ObjectDetection()
		detector.setModelTypeAsRetinaNet()
		detector.setModelPath( os.path.join(execution_path , "resnet50_coco_best_v2.0.1.h5"))
		detector.loadModel()
		
		detections = detector.detectObjectsFromImage(input_image=os.path.join(image_path , path), output_image_path=os.path.join(image_path , newfile))
		
		response = newfile
		dispatcher.utter_attachment(response)
		return[]