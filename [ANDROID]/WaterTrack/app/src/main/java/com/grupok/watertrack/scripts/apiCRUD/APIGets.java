package com.grupok.watertrack.scripts.apiCRUD;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class APIGets {
    public void getUsers(Context context){
        RequestQueue queue = Volley.newRequestQueue(context);
        String url ="http://localhost/yii2test/backend/web/api/users";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, url, null, new Response.Listener<JSONObject>() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONArray jsonArray = response.getJSONArray("user");

                    for (int i = 0; i < jsonArray.length(); i++) {
                        JSONObject hit = jsonArray.getJSONObject(i);

                        int id = hit.getInt("id");
                        String name = hit.getString("username");
                        String desc = hit.getString("auth_key");

                        Toast.makeText(context, ""+id+" , "+name+" , "+desc, Toast.LENGTH_SHORT).show();

                    }
                } catch (JSONException e) {
                    throw new RuntimeException(e);
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, "NETWORK ERROR", Toast.LENGTH_SHORT).show();
            }
        });

        // Add the request to the RequestQueue.
        queue.add(request);
    }
}
