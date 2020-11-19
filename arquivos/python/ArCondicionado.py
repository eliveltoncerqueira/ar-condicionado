# Copyright Amazon.com, Inc. or its affiliates. All Rights Reserved.
# SPDX-License-Identifier: MIT-0


import time
import json
import AWSIoTPythonSDK.MQTTLib as AWSIoTPyMQTT
while True:
        # Define ENDPOINT, CLIENT_ID, PATH_TO_CERT, PATH_TO_KEY, PATH_TO_ROOT, MESSAGE, TOPIC, and RANGE
        ENDPOINT = "ENDPOINT"
        CLIENT_ID = "COISA"
        PATH_TO_CERT = "certificate.pem.crt"
        PATH_TO_KEY = "private.pem.key"
        PATH_TO_ROOT = "certificados/AmazonRootCA1.pem.txt"
        TOPIC_TO_SUBSCRIBE = "TOPICO"
        TOPIC_TO_SUBSCRIBE2 = "TOPICO"
        def acionarAr(client, userdata, message):
                tempMin = json.loads(message.payload.decode("utf-8"))['tempMin']
                tempMax = json.loads(message.payload.decode("utf-8"))['tempMax']
                dados = {
                        'temperatura-ar':((tempMin + tempMax)/2),
                        'status': 1
                }
                print("Ar Ligado")
                with open('../json/ar-condicionado.json', 'w') as json_file:
                        json.dump(dados, json_file)
        def desativarAr(client, userdata, message):
                dados = {
                        'status': 0
                }
                print("Ar Desligado")
                with open('../json/ar-condicionado.json', 'w') as json_file:
                        json.dump(dados, json_file)

        myAWSIoTMQTTClient = AWSIoTPyMQTT.AWSIoTMQTTClient(CLIENT_ID)
        myAWSIoTMQTTClient.configureEndpoint(ENDPOINT, 8883)
        myAWSIoTMQTTClient.configureCredentials(PATH_TO_ROOT, PATH_TO_KEY, PATH_TO_CERT)
        myAWSIoTMQTTClient.connect(5)
        myAWSIoTMQTTClient.subscribe(TOPIC_TO_SUBSCRIBE, 0, acionarAr)
        myAWSIoTMQTTClient.subscribe(TOPIC_TO_SUBSCRIBE2, 0, desativarAr)
        print("verificandoStatusAr")
        time.sleep(5)
        myAWSIoTMQTTClient.disconnect()
