package com.grupok.watertrack.fragments.authactivity;

import android.os.AsyncTask;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.room.Room;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.AuthActivity;
import com.grupok.watertrack.database.LocalDataBase;
import com.grupok.watertrack.database.daos.ContadoresDao;
import com.grupok.watertrack.database.daos.LogsContadoresDao;
import com.grupok.watertrack.database.daos.UserInfosDao;
import com.grupok.watertrack.database.entities.UserInfosEntity;
import com.grupok.watertrack.databinding.FragmentLoginBinding;
import com.grupok.watertrack.databinding.FragmentRegisterBinding;

public class RegisterFragment extends Fragment {

    private AuthActivity parent;
    private FragmentRegisterBinding binding;
    private String loginEmailInputed;
    private LocalDataBase localDataBase;
    private LogsContadoresDao logsContadoresDao;
    private ContadoresDao contadoresDao;
    private UserInfosDao userInfosDao;

    public RegisterFragment() {
        // Required empty public constructor
    }

    public RegisterFragment(AuthActivity parent) {
        this.parent = parent;
    }

    public RegisterFragment(AuthActivity parent, String loginEmailInputed) {
        this.parent = parent;
        this.loginEmailInputed = loginEmailInputed;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentRegisterBinding.inflate(inflater);

        init();

        return binding.getRoot();
    }

    private void init(){
        setupOldUserBut();
        setupLoginBut();

        loadOldInfo();

        setupLocalDataBase();
    }

    //------------------------------- SETUPS -----------------------------------
    private void setupLoginBut(){
        binding.butRegisterRegisterFragAuthAc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //new LocalDatabaseUpdateTask().execute();
            }
        });
    }
    private void setupOldUserBut(){
        binding.butOldUserRegisterFragAuthAc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                parent.cycleFragments("LoginFrag", binding.editTextEmailRegisterFragAuthAc.getText().toString(), null);
            }
        });
    }

    //------------------------------- OUTROS -------------------------------------
    private void loadOldInfo(){
        if(!loginEmailInputed.isEmpty()){
            binding.editTextEmailRegisterFragAuthAc.setText(loginEmailInputed);
        }
    }
    private void setupLocalDataBase(){
        localDataBase = Room.databaseBuilder(getContext(), LocalDataBase.class, "WaterTrackLocalDB").build();
        logsContadoresDao = localDataBase.logsContadoresDao();
        contadoresDao = localDataBase.contadoresDao();
        userInfosDao = localDataBase.userInfosDao();
    }
}