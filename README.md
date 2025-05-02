# Agriaid - Crop Management System

Agriaid is a comprehensive Crop Management System designed to assist farmers with data-driven insights and predictions. It leverages machine learning models and web technologies to provide crop prediction, fertilizer recommendation, rainfall prediction, and yield forecasting.

---

## Project Overview

The Crop Management System is a machine learning-based project designed to provide predictions and recommendations for farmers. The system uses different algorithms to predict crops, recommend fertilizers, and provide rainfall and yield predictions to help farmers make informed decisions about their crops.

### Features
- Crop Prediction
- Crop Recommendation
- Fertilizer Recommendation
- Rainfall Prediction
- Yield Prediction

### Technologies Used
- Python
- PHP
- Pandas
- NumPy
- JavaScript
- HTML/CSS
- Bootstrap4
- Scikit-learn

---

## Installation

1. Clone the repository to your local machine.
```bash
git clone https://github.com/ab007shetty/crop-management-system.git
```
2. Install the required packages using pip.
```bash
pip install -r requirements.txt
```
3. Run Apache web server using XAMPP.

---

## Dataset Overview

The system uses multiple datasets for different modules including crop prediction, fertilizer recommendation, rainfall prediction, and yield prediction. These datasets include features such as soil nutrients, weather parameters, crop types, and historical production data.

---

## Crop Prediction Subproject - ApnaAnaaj

The Crop Prediction module, named ApnaAnaaj, provides detailed crop value forecasting for around 23 commodities using Decision Tree Regression techniques. It offers crop price predictions with 93-95% accuracy and detailed analysis using tables and charts.

### Features
- Forecast crop values up to next 12 months
- Top gainers and losers of current time
- Model trained on authenticated datasets from [data.gov.in](https://data.gov.in)
- User-friendly UI built with MaterializeCSS
- Uses Python, Flask, Scikit-Learn, and Chart.js

### Installation Guide for Crop Prediction
```bash
git clone https://github.com/rahuldkjain/Crop_Prediction.git
cd Crop_Prediction
pip install -r requirements.txt
python app.py
```

---

## Screenshots

### Crop Prediction Dashboard
![Crop Prediction Dashboard](AgriAid/Crop_Prediction/static/Screenshot%20(23).png)

### Crop Price Trends
![Crop Price Trends](AgriAid/Crop_Prediction/static/Screenshot%20(24).png)

### Top Gainers and Losers
![Top Gainers and Losers](AgriAid/Crop_Prediction/static/Screenshot%20(25).png)

### Detailed Crop Analysis
![Detailed Crop Analysis](AgriAid/Crop_Prediction/static/Screenshot%20(26).png)

---

## How to Use

- **Crop Prediction:** Input `State_Name`, `District_Name`, and `Season` to get the predicted crop for that location.
- **Crop Recommendation:** Input soil nutrients and weather parameters to get recommended crops.
- **Fertilizer Recommendation:** Input soil and crop details to get fertilizer recommendations.
- **Rainfall Prediction:** Input subdivision and year to get rainfall predictions.
- **Yield Prediction:** Input crop and location details to get yield forecasts.

---

## Contributors

- Abdul Basit
- Aamir khan
- Farhaan sheikh
---


