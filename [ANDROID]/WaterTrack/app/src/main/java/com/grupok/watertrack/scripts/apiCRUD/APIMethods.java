package com.grupok.watertrack.scripts.apiCRUD;

import android.content.Context;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;
import com.grupok.watertrack.database.entities.UserInfosEntity;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class APIMethods {
    private GetUsersResponse getUsersResponse;
    public interface GetUsersResponse{
        void onGetUsersResponse(int responseType, List<UserInfosEntity> users);
    }
    public void setGetUsersResponse(GetUsersResponse listenner){
        this.getUsersResponse = listenner;
    }
    public void getUsers(Context context){
        RequestQueue queue = Volley.newRequestQueue(context);
        String url ="http://172.22.21.222/watertrack/backend/web/api/users";
        List<UserInfosEntity> users = new ArrayList<>();
        JsonArrayRequest request = new JsonArrayRequest(
                Request.Method.GET,
                url,
                null,
                response -> {
                    try {
                        for (int i = 0; i < response.length(); i++) {
                            JSONObject hit = response.getJSONObject(i);

                            /*UserInfosEntity user = new UserInfosEntity(
                                    hit.getString("username"),
                                    hit.getString("email"),
                                    hit.getString("password_hash"),
                                    "",
                                    1,
                                    "",
                                    ""
                            );*/

                            //users.add(user);
                        }

                        getUsersResponse.onGetUsersResponse(1, users);

                    } catch (JSONException e) {
                        e.printStackTrace();
                        getUsersResponse.onGetUsersResponse(0, users);
                    }
                },
                error -> {
                    Toast.makeText(context, "NETWORK ERROR", Toast.LENGTH_SHORT).show();
                    getUsersResponse.onGetUsersResponse(0, users);
                }
        );

        // Add the request to the RequestQueue.
        queue.add(request);
    }

    private LoginResponse loginResponse;
    public interface LoginResponse{
        void onLoginResponse(boolean response, UserInfosEntity user, String message);
    }
    public void setLoginResponse(LoginResponse listenner){
        this.loginResponse = listenner;
    }
    public void login(Context context, View snackBarView, String username, String password) {
        RequestQueue queue = Volley.newRequestQueue(context);
        String url = "http://172.22.21.222/watertrack/backend/web/api/auth/login";

        JSONObject json = new JSONObject();
        try{
            json.put("username", username);
            json.put("password", password);
        } catch (JSONException e) {
            throw new RuntimeException(e);
        }

        JsonObjectRequest request = new JsonObjectRequest(
                Request.Method.POST, url, json,
                response -> {
                    // login success
                    try{
                        switch (response.getInt("success")){
                            case 0:
                                JSONObject userObject = response.getJSONObject("user");
                                UserInfosEntity user = new UserInfosEntity(userObject.getInt("userId"),
                                        userObject.getString("username"),
                                        userObject.getString("email"),
                                        userObject.getInt("status"));

                                try{
                                    user.setProfileInfo(userObject.getString("birthDate"), userObject.getString("address"));
                                } catch (Exception e) {
                                    Log.i("API_Login", "Profile Info not found.");
                                }
                                try{
                                    user.setTechInfo(userObject.getInt("enterpriseID"), userObject.getString("certificationNumber"));
                                } catch (Exception e) {
                                    Log.i("API_Login", "Technician Info not found.");
                                }
                                loginResponse.onLoginResponse(true, user, "");
                                break;
                            case 2: // Username and password required
                            case 3: // User not found
                            case 4: // Incorrect password
                                loginResponse.onLoginResponse(false, null, response.getString("message"));
                                break;
                        }
                    } catch (JSONException e) {
                        loginResponse.onLoginResponse(false, null, "JSON PARSE ERROR");
                    }
                },
                error -> {
                    loginResponse.onLoginResponse(false, null, "Volley ERROR");
                }
        );

        queue.add(request);
    }
}
