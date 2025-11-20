// Configuration and state
let tokenClient;
const SCOPES = 'https://www.googleapis.com/auth/fitness.activity.read https://www.googleapis.com/auth/fitness.body.read';
const CLIENT_ID = '888980115098-0tbia4b90bpej5s89i3s3jiabl8h4d4e.apps.googleusercontent.com';
const API_KEY = 'AIzaSyCId_59vuR-dPoL_TVQqWdxrZ-zpbN6pFs';

// Initialize the Google API client
function initializeGoogleApi() {
    tokenClient = google.accounts.oauth2.initTokenClient({
        client_id: CLIENT_ID,
        scope: SCOPES,
        callback: handleAuthResponse
    });

    gapi.load('client', async () => {
        try {
            await gapi.client.init({
                apiKey: API_KEY,
                discoveryDocs: ['https://www.googleapis.com/discovery/v1/apis/fitness/v1/rest']
            });
            document.getElementById('authorize-button').disabled = false;
        } catch (error) {
            console.error('Error initializing GAPI client:', error);
            alert('Error initializing Google API client.');
        }
    });
}

// Handle authentication response
function handleAuthResponse(response) {
    if (response.error !== undefined) {
        console.error('Auth error:', response);
        alert('Authentication failed. Please try again.');
        return;
    }
    
    // Hide setup section and show data section
    document.getElementById('setup-section').style.display = 'none';
    document.getElementById('data-section').classList.remove('hidden');
    
    // Fetch initial data
    fetchFitnessData();
}

 // Fetch fitness data
// ... existing configuration and initialization code ...

async function fetchFitnessData() {
    try {
        const now = new Date();
        const startTime = new Date(now.setHours(0, 0, 0, 0)).getTime();
        const endTime = new Date().getTime();

        // Show loading state
        document.getElementById('steps-count').textContent = 'Loading...';
        document.getElementById('heart-rate').textContent = 'Loading...';
        document.getElementById('distance-traveled').textContent = 'Loading...';
        document.getElementById('move-minutes').textContent = 'Loading...';
        document.getElementById('calories-burned').textContent = 'Loading...';

        // Check authentication
        if (!gapi.client.getToken()) {
            throw new Error('Not authenticated');
        }

        const requestBody = {
            aggregateBy: [{
                dataTypeName: 'com.google.step_count.delta'
            }],
            bucketByTime: { durationMillis: 86400000 },
            startTimeMillis: startTime,
            endTimeMillis: endTime
        };

        const [stepsData, heartPointsData, distanceData, moveMinData, caloriesData] = await Promise.all([
            // Fetch steps
            gapi.client.request({
                path: 'fitness/v1/users/me/dataset:aggregate',
                method: 'POST',
                body: requestBody
            }),
            // Fetch heart points
            gapi.client.request({
                path: 'fitness/v1/users/me/dataset:aggregate',
                method: 'POST',
                body: {
                    ...requestBody,
                    aggregateBy: [{
                        dataTypeName: 'com.google.heart_minutes'
                    }]
                }
            }),
            // Fetch distance
            gapi.client.request({
                path: 'fitness/v1/users/me/dataset:aggregate',
                method: 'POST',
                body: {
                    ...requestBody,
                    aggregateBy: [{
                        dataTypeName: 'com.google.distance.delta'
                    }]
                }
            }),
            // Fetch move minutes
            gapi.client.request({
                path: 'fitness/v1/users/me/dataset:aggregate',
                method: 'POST',
                body: {
                    ...requestBody,
                    aggregateBy: [{
                        dataTypeName: 'com.google.active_minutes'
                    }]
                }
            }),
            // Fetch calories
            gapi.client.request({
                path: 'fitness/v1/users/me/dataset:aggregate',
                method: 'POST',
                body: {
                    ...requestBody,
                    aggregateBy: [{
                        dataTypeName: 'com.google.calories.expended'
                    }]
                }
            })
        ]);

        // Process and display data
        const steps = stepsData.result.bucket?.[0]?.dataset?.[0]?.point?.[0]?.value?.[0]?.intVal || 0;
        document.getElementById('steps-count').textContent = steps.toLocaleString();

        // Process heart points
        const heartPoints = heartPointsData.result.bucket?.[0]?.dataset?.[0]?.point?.[0]?.value?.[0]?.fpVal || 0;
        document.getElementById('heart-rate').textContent = Math.round(heartPoints).toLocaleString();

        // Process distance
        const distanceMeters = distanceData.result.bucket?.[0]?.dataset?.[0]?.point?.[0]?.value?.[0]?.fpVal || 0;
        const distanceKm = (distanceMeters / 1000).toFixed(2);
        document.getElementById('distance-traveled').textContent = distanceKm;

        // Process move minutes
        const moveMinutes = moveMinData.result.bucket?.[0]?.dataset?.[0]?.point?.[0]?.value?.[0]?.intVal || 0;
        document.getElementById('move-minutes').textContent = moveMinutes;

        // Process calories
        const calories = caloriesData.result.bucket?.[0]?.dataset?.[0]?.point?.[0]?.value?.[0]?.fpVal || 0;
        document.getElementById('calories-burned').textContent = Math.round(calories).toLocaleString();

    } catch (error) {
        console.error('Error fetching fitness data:', error);
        handleFetchError();
        if (error.message === 'Not authenticated') {
            tokenClient?.requestAccessToken();
        }
    }
}

// Update handleFetchError function to include heart-rate
function handleFetchError() {
    document.getElementById('steps-count').textContent = '--';
    document.getElementById('heart-rate').textContent = '--';
    document.getElementById('distance-traveled').textContent = '--';
    document.getElementById('move-minutes').textContent = '--';
    document.getElementById('calories-burned').textContent = '--';
    alert('Unable to fetch fitness data. Please check your Google Fit app data and try again.');
}

// ... rest of the existing code ...

// Add event listener for refresh button
document.getElementById('refresh-button')?.addEventListener('click', fetchFitnessData);



