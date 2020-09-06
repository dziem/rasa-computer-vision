import logging
from rasa_core.agent import Agent
from rasa_core.interpreter import RasaNLUInterpreter
from rasa_core.policies.keras_policy import KerasPolicy
from rasa_core.policies.memoization import MemoizationPolicy
from rasa_core.policies import FallbackPolicy

if __name__  == '__main__':
	logging.basicConfig(level='INFO')
	
	model_path = './models/dialogue'
	# action ketika ada pesan yang tidak diketahui berdasarkan threshold ex. maaf tidak tahu
	fallback = FallbackPolicy(fallback_action_name="utter_unclear", core_threshold=0.3, nlu_threshold=0.3)
	interpreter = RasaNLUInterpreter("./models/nlu/default/gambar_nlu")
	agent = Agent("gambar_domain.yml", policies=[MemoizationPolicy(), KerasPolicy(), fallback])
	
	training_data = agent.load_data("./data/stories.md")
	agent.train(training_data)
	agent.persist(model_path)
	
	agent= Agent.load("./models/dialogue",interpreter=interpreter)
	