# Copyright Amazon.com, Inc. or its affiliates. All Rights Reserved.
# SPDX-License-Identifier: MIT-0


import time
import json
import AWSIoTPythonSDK.MQTTLib as AWSIoTPyMQTT
import requests

def buscarUmidade():
    # Define ENDPOINT, CLIENT_ID, PATH_TO_CERT, PATH_TO_KEY, PATH_TO_ROOT, MESSAGE, TOPIC, and RANGE
    with open('../json/umidade.json', 'r') as json_file:
        dados = json.dumps(json.load(json_file))
    ENDPOINT = "ENDPOINT"
    CLIENT_ID = "COISA"
    PATH_TO_CERT = "certificate.pem.crt"
    PATH_TO_KEY = "private.pem.key"
    PATH_TO_ROOT = "certificados/AmazonRootCA1.pem.txt"
    TOPIC = "TOPICO"


    myAWSIoTMQTTClient = AWSIoTPyMQTT.AWSIoTMQTTClient(CLIENT_ID)
    myAWSIoTMQTTClient.configureEndpoint(ENDPOINT, 8883)
    myAWSIoTMQTTClient.configureCredentials(PATH_TO_ROOT, PATH_TO_KEY, PATH_TO_CERT)

    myAWSIoTMQTTClient.connect(2)
    myAWSIoTMQTTClient.publish(TOPIC, dados, 0)
    myAWSIoTMQTTClient.disconnect()
