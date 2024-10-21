import json
import os
import joblib
import pandas as pd

print("Current working directory:", os.getcwd())

# Load the models
voice_model = joblib.load('C:/xampp/htdocs/voice_model.pkl')
ge_model = joblib.load('C:/xampp/htdocs/ge_model.pkl')
coc_model = joblib.load('C:/xampp/htdocs/coc_model.pkl')
pol_model = joblib.load('C:/xampp/htdocs/pol_model.pkl')
rol_model = joblib.load('C:/xampp/htdocs/rol_model.pkl')
rq_model = joblib.load('C:/xampp/htdocs/rq_model.pkl')

# Read the input data from the file
file_path = 'C:/xampp/htdocs/input.txt'
if os.path.exists(file_path):
    try:
        with open(file_path, 'r') as f:
            input_data = f.read()
            print(f"Input data from file: {input_data}")
            data = json.loads(input_data)
            country = data['country']
            year = int(data['year'])
            print(f"Received country: {country}, year: {year}")

            # Full country list with proper feature names
            country_list = [
                'Country/Territory_Albania', 'Country/Territory_Algeria',
                'Country/Territory_Andorra', 'Country/Territory_Angola',
                'Country/Territory_Antigua and Barbuda', 'Country/Territory_Argentina',
                'Country/Territory_Armenia', 'Country/Territory_Australia', 
                'Country/Territory_Austria', 'Country/Territory_United Arab Emirates',
                'Country/Territory_India', 'year'
                # Add all countries used during model training
            ]
            
            feature_names = country_list  # 'year' is not included in feature names
            
            # Create feature vector with correct names
            X = pd.DataFrame(0, index=[0], columns=feature_names)
            X.at[0, 'year'] = year
            X.at[0, f'Country/Territory_{country.capitalize()}'] = 1

            # Simulate prediction with correct features
            ratings = {
                'voice': voice_model.predict(X)[0],
                'ge': ge_model.predict(X)[0],
                'coc': coc_model.predict(X)[0],
                'pol': pol_model.predict(X)[0],
                'rol': rol_model.predict(X)[0],
                'rq': rq_model.predict(X)[0]
            }
            print(json.dumps(ratings))
    except Exception as e:
        print(f"Error processing the input: {e}")
else:
    print(f"File not found: {file_path}")
