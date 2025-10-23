package com.grupok.watertrack.activitys;

import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.os.AsyncTask;
import android.os.Bundle;

import androidx.activity.EdgeToEdge;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.room.Room;

import com.grupok.watertrack.database.LocalDataBase;
import com.grupok.watertrack.database.daos.ContadoresDao;
import com.grupok.watertrack.database.daos.LogsContadoresDao;
import com.grupok.watertrack.database.daos.UserInfosDao;
import com.grupok.watertrack.database.entities.UserInfosEntity;
import com.grupok.watertrack.databinding.ActivityAuthBinding;
import com.grupok.watertrack.R;
import com.grupok.watertrack.fragments.authactivity.LoginFragment;
import com.grupok.watertrack.fragments.authactivity.RegisterFragment;

public class AuthActivity extends AppCompatActivity {

    private ActivityAuthBinding binding;
    private boolean isLogged;
    private AuthActivity THIS;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityAuthBinding.inflate(getLayoutInflater());
        //EdgeToEdge.enable(this);
        setContentView(binding.getRoot());

        //-------------------- SHAREDPREFERENCE INFO ------------------------
        SharedPreferences prefs = getSharedPreferences("Perf_User", MODE_PRIVATE);
        isLogged = prefs.getBoolean("logged", false);

        if(isLogged){
            Intent intent = new Intent(AuthActivity.this, MainActivity.class);
            startActivity(intent);
        }else{
            cycleFragments("LoginFrag", "");
        }
    }

    public void cycleFragments(String goTo, String extra){
        switch (goTo){
            case "LoginFrag":
                getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container_auth_activity, new LoginFragment(this, extra)).commitAllowingStateLoss();
                break;
            case "RegisterFrag":
                getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container_auth_activity, new RegisterFragment(this, extra)).commitAllowingStateLoss();
                break;
            case "MainAC":
                Intent intent = new Intent(AuthActivity.this, MainActivity.class);
                intent.putExtra("currentUser", extra);
                startActivity(intent);
                break;
        }
    }

    @Override
    public void onConfigurationChanged(@NonNull Configuration newConfig) {
        super.onConfigurationChanged(newConfig);
        if (newConfig.uiMode != getApplicationContext().getResources().getConfiguration().uiMode) {
            recreate();
        }
    }
}