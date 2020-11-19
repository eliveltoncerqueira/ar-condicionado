# Copyright Amazon.com, Inc. or its affiliates. All Rights Reserved.
# SPDX-License-Identifier: MIT-0



import datetime
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
        def customCallback(client, userdata, message):
                print(message.payload.decode("utf-8") )
                f = open('../json/temperatura-iot.json', 'w')
                f.write(message.payload.decode("utf-8"))
                f.close()



        myAWSIoTMQTTClient = AWSIoTPyMQTT.AWSIoTMQTTClient(CLIENT_ID)
        myAWSIoTMQTTClient.configureEndpoint(ENDPOINT, 8883)
        myAWSIoTMQTTClient.configureCredentials(PATH_TO_ROOT, PATH_TO_KEY, PATH_TO_CERT)
        myAWSIoTMQTTClient.connect(5)
        myAWSIoTMQTTClient.subscribe(TOPIC_TO_SUBSCRIBE, 0, customCallback)
        time.sleep(5)
        myAWSIoTMQTTClient.disconnect()
