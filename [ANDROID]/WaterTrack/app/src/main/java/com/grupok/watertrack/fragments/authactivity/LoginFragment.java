package com.grupok.watertrack.fragments.authactivity;

import android.os.AsyncTask;
import android.os.Bundle;

import androidx.fragment.app.Fragment;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.grupok.watertrack.R;
import com.grupok.watertrack.activitys.AuthActivity;
import com.grupok.watertrack.database.entities.UserInfosEntity;
import com.grupok.watertrack.databinding.FragmentLoginBinding;

public class LoginFragment extends Fragment {
    private AuthActivity parent;
    private FragmentLoginBinding binding;
    private String loginEmailInputed;

    public LoginFragment() {
        // Required empty public constructor
    }

    public LoginFragment(AuthActivity parent) {
        this.parent = parent;
    }

    public LoginFragment(AuthActivity parent, String loginEmailInputed) {
        this.parent = parent;
        this.loginEmailInputed = loginEmailInputed;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentLoginBinding.inflate(inflater);

        init();

        return binding.getRoot();
    }

    private void init(){
        setupNewUserBut();
        setupLoginBut();

        loadOldInfo();
    }

    //------------------------------- SETUPS -----------------------------------
    private void setupLoginBut(){
        binding.butLoginLoginFragAuthAc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                parent.cycleFragments("MainAC", binding.editTextEmailLoginFragAuthAc.getText().toString());
            }
        });
    }
    private void setupNewUserBut(){
        binding.butRegisterLoginFragAuthAc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                parent.cycleFragments("RegisterFrag", binding.editTextEmailLoginFragAuthAc.getText().toString());
            }
        });
    }

    //------------------------------- OUTROS -------------------------------------
    private void loadOldInfo(){
        if(loginEmailInputed != null){
            if(!loginEmailInputed.isEmpty()){
                binding.editTextEmailLoginFragAuthAc.setText(loginEmailInputed);
            }
        }
    }

}