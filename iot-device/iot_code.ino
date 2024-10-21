#include <WiFi.h>    // For ESP32
#include <HTTPClient.h>

const char* ssid = "your_SSID";  // Replace with your Wi-Fi SSID
const char* password = "your_PASSWORD";  // Replace with your Wi-Fi password

const char* serverName = "http://your-server-url.com/receive_data.php";

// Example sensor data
float pH = 7.4;
float turbidity = 1.2;
float residualChlorine = 0.3;
float conductivity = 780.0;
float temperature = 22.5;

void setup() {
  Serial.begin(115200);
  
  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  Serial.println("Connecting to WiFi...");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting...");
  }
  
  Serial.println("Connected to WiFi");
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    
    // Prepare the URL for sending data
    http.begin(serverName);

    // Specify the content type as JSON
    http.addHeader("Content-Type", "application/json");

    // Create JSON string with sensor data
    String jsonData = "{";
    jsonData += "\"sensor_id\":\"sensor_001\",";
    jsonData += "\"pH\":" + String(pH) + ",";
    jsonData += "\"turbidity\":" + String(turbidity) + ",";
    jsonData += "\"residual_chlorine\":" + String(residualChlorine) + ",";
    jsonData += "\"conductivity\":" + String(conductivity) + ",";
    jsonData += "\"temperature\":" + String(temperature);
    jsonData += "}";

    // Send the POST request
    int httpResponseCode = http.POST(jsonData);

    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println(httpResponseCode);
      Serial.println(response);
    } else {
      Serial.println("Error in sending POST request");
    }

    http.end();
  }

  delay(60000);  // Send data every 60 seconds
}
