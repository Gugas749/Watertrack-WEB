package com.grupok.watertrack.fragments.mainactivityfrags;

import android.content.Context;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;

import android.util.TypedValue;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.google.android.material.snackbar.Snackbar;
import com.grupok.watertrack.R;
import com.grupok.watertrack.database.entities.ContadorEntity;
import com.grupok.watertrack.activitys.MainActivity;
import com.grupok.watertrack.databinding.FragmentMainACMainViewBinding;
import com.grupok.watertrack.scripts.SnackBarShow;

import java.util.List;

public class MainACMainView extends Fragment {

    private MainActivity parent;
    private Context context;
    private MainACMainView THIS;
    private SnackBarShow snackBarShow;
    private FragmentMainACMainViewBinding binding;
    private List<ContadorEntity> contadoresEntityList;
    private RVAdapterMainAcMainView adapter;

    public MainACMainView() {
        // Required empty public constructor
    }

    public MainACMainView(MainActivity parent, List<ContadorEntity> contadoresEntityList) {
        this.parent = parent;
        this.contadoresEntityList = contadoresEntityList;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        binding = FragmentMainACMainViewBinding.inflate(inflater);

        if(parent.currentUserInfo != null){
            init();
        }

        return binding.getRoot();
    }

    private void init(){
        THIS = this;
        context = getContext();
        adapter = new RVAdapterMainAcMainView(this.getContext(), contadoresEntityList, parent.currentUserInfo.Cargo);
        snackBarShow = new SnackBarShow();

        loadRv();
        setupSearchButton();
        setupAddContadorButton();
    }
    private void setupSearchButton(){
        binding.butSearchContadorMainViewMainAc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(binding.textViewNoItemsToDisplayFragBackups.getVisibility() == View.VISIBLE){
                    snackBarShow.display(binding.getRoot(), "FOI", -1, 1, binding.butSearchContadorMainViewMainAc, context);
                }else{
                    binding.outlinedTextFieldSearchMainViewFragMainAc.setVisibility(View.VISIBLE);
                }
            }
        });
    }
    private void setupAddContadorButton(){
        binding.butAddContadorMainViewMainAc.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });
    }
    //-------------------------FUNCTIONS-------------------------------
    private void loadRv(){
        if(contadoresEntityList.size() > 0){
            adapter.updateData(contadoresEntityList);
            binding.rvContadoresMainViewMainAc.setLayoutManager(new LinearLayoutManager(getContext()));
            binding.rvContadoresMainViewMainAc.setAdapter(adapter);
            adapter.notifyDataSetChanged();
        }else{
            binding.textViewNoItemsToDisplayFragBackups.setVisibility(View.VISIBLE);
            binding.rvContadoresMainViewMainAc.setVisibility(View.GONE);
        }

    }
}